<?php
$did = isset($vars[1]) ? strip_tags($vars[1]) : null;
if (is_null($did)) {
  HTML::forward('/404');
}
$deal = Deal::findById($did);
if (!$deal) {
  HTML::forward('/404');
}


global $conf;
// login to sydneytoday first
$user = new SydneytodayUser($conf['sydneytoday']['username'], $conf['sydneytoday']['password']);
$user->login($conf['sydneytoday']['loginurl'], true);

// post qaptcha_key first
$curl = new Curl($user->getCookiePath());
$qaptcha_key = "tbBd%23ZA63m3VukNdmw_US9uwPsMj5-Gz";
$result = $curl->post(
        $conf['sydneytoday']['qaptcha_url'], 
        "action=qaptcha&qaptcha_key=" . $qaptcha_key,
        null,
        true
);

// post deal on sydneytoday
$length = mb_strlen($deal->getTitle(), 'UTF-8');
$split_point = rand(0, $length - 1);
$rest_length = $length - $split_point;
$title = mb_substr($deal->getTitle(), 0, $split_point, 'UTF-8');
$title.= ' ';
$title.= mb_substr($deal->getTitle(), $split_point, $rest_length, 'UTF-8');
for ($i = 0; $i < rand(0, 4); $i++) {
  $title.= ' ';
}
$title = mb_convert_encoding($title, 'GB2312', 'UTF-8');

$type;
switch ($deal->getCategory()->getId()) {
  case 'food':
    $type = 3; break;
  case 'event':
    $type = 5; break;
  case 'goods':
    $type = 5; break;
  case 'travel':
    $type = 3; break;
}

$data[] = "postdb[city_id]=1"; // --
$data[] = "postdb[title]=" . $title; // --
$data[] = "postdb[linkman]=" . urlencode('Groupon'); // --
$data[] = "postdb[content]=" . urlencode(mb_convert_encoding($deal->getDetails(), 'GB2312', 'UTF-8')); // --
$data[] = "postdb[telephone]=";
$data[] = "postdb[mobphone]=";
$data[] = "postdb[fax]=";
$data[] = "postdb[oicq]=";
$data[] = "postdb[msn]";
$data[] = "postdb[email]";
$data[] = "postdb[my_host]=" . urlencode('Groupon');
$data[] = "postdb[sortid]=" . urlencode($type); // --
$data[] = "postdb[my_price]=" . urlencode(mb_convert_encoding($deal->getDiscount(), 'GB2312', 'UTF-8')); // --
$data[] = "postdb[my_time]=";
$data[] = "postdb[my_expressurl]=" . urlencode($conf['site_url'] . $deal->getPageUrl());
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
        'http://www.sydneytoday.com/post.php?fid=194',
        true
);

// deal with error
$matches = array();
$text;
if (preg_match('/alert\(\'(.*)\'\);/', $result, $matches)) {
  $text = mb_convert_encoding($matches[1], 'UTF-8', 'GB2312');
  if ($text != '内容正在提交...') {
    echo $text;
    exit;
  }
}


// create instance and update deal
$now = time();

$instance = new SydneytodayDealInstance();
$instance->setDeal($deal);
$instance->setCreatedAt($now);
$instance->save();
//$deal->setLastPublished($now);
//$deal->save();

if ($text == '内容正在提交...') {
  echo $text;
} else {
  echo time_ago($now);
}
