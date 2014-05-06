<?php
$did = isset($vars[1]) ? strip_tags($vars[1]) : null;
if (is_null($did)) {
  HTML::forward('/404');
}
$deal = SydneytodayDeal::findById($did);
if (!$deal) {
  HTML::forward('/404');
}


global $conf;
// login to sydneytoday first
$user = new SydneytodayUser($conf['sydneytoday']['username'], $conf['sydneytoday']['password']);
$user->login($conf['sydneytoday']['loginurl']);

// post qaptcha_key first
$curl = new Curl($user->getCookiePath());
$qaptcha_key = "tbBd%23ZA63m3VukNdmw_US9uwPsMj5-Gz";
$result = $curl->post(
        $conf['sydneytoday']['qaptcha_url'], 
        "action=qaptcha&qaptcha_key=" . $qaptcha_key
);

// post deal on sydneytoday
$data[] = "postdb[city_id]=1"; // --
$data[] = "postdb[title]=" . urlencode($deal->getTitle()); // --
$data[] = "postdb[linkman]=" . urlencode($deal->getContact()); // --
$data[] = "postdb[telephone]=";
$data[] = "postdb[mobphone]=";
$data[] = "postdb[fax]=";
$data[] = "postdb[oicq]=";
$data[] = "postdb[msn]";
$data[] = "postdb[email]";
$data[] = "postdb[my_host]=";
$data[] = "postdb[sortid]=" . urlencode($deal->getType()); // --
$data[] = "postdb[my_price]=" . urlencode($deal->getDiscount()); // --
$data[] = "postdb[my_time]=";
$data[] = "postdb[my_expressurl]=" . urlencode($deal->getGrouponLink());
$data[] = "titledb[1]=";
$data[] = "photodb[1]=" . urlencode($deal->getImage());
$data[] = "local_file1=";
$data[] = "ftype[1]=out";
$data[] = "nums=1";
$data[] = $qaptcha_key . "=";
$data[] = "submit=提 交";
$data[] = "fid=194";
$data[] = "id=0";

$result = $curl->post(
        $conf['sydneytoday']['post_url'], 
        implode('&', $data),
        'http://www.sydneytoday.com/post.php?fid=194'
);
die($result);

// create instance and update deal
$deal = SydneytodayDeal::findById($did);
$now = time();

$instance = new SydneytodayDealInstance();
$instance->setDeal($deal);
$instance->setCreatedAt($now);
$instance->save();
$deal->setLastPublished($now);
$deal->save();

echo time_ago($now);

$dd = "X9sdz-EbHwgjNZQ6QPSypMqsjy4EwxZ4";
$jj = "REvtRzn";