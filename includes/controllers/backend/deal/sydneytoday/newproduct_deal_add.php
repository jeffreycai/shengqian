<?php

$did = isset($vars[1]) ? strip_tags($vars[1]) : null;
if (is_null($did)) {
  HTML::forward('/404');
}
$deal = Deal::findById($did);
if (!$deal) {
  HTML::forward('/404');
}

//_debug(html_to_text($deal->getDetails()));

global $conf;
// login to sydneytoday first
$user = new SydneytodayUser($conf['sydneytoday']['username'], $conf['sydneytoday']['password']);
$user->login($conf['sydneytoday']['loginurl'], true);

// post qaptcha_key first
$curl = new Curl($user->getCookiePath());
$qaptcha_key = "NXtpbh65RQugNqPqfGdUDJX7G267D8XK";
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
    $type = '烟酒食品'; break;
  case 'event':
    $type = '游戏娱乐'; break;
  case 'goods':
    $type = '家居用品'; break;
  case 'travel':
    $type = '游戏娱乐'; break;
}


$data[] = "postdb[title]=" . $title; // --
$data[] = "postdb[linkman]=" . urlencode('AuSaving.com'); // --
$data[] = "postdb[telephone]=";
$data[] = "postdb[mobphone]=";
$data[] = "postdb[fax]=";
$data[] = "postdb[oicq]=";
$data[] = "postdb[msn]=";
$data[] = "postdb[email]=";
$data[] = "postdb[zone_id]=";
$data[] = "postdb[city_id]=1"; // --
$data[] = "postdb[my_790gq]=" . urlencode(mb_convert_encoding("出售", 'GB2312', 'UTF-8')); // -- sale or require
$data[] = "postdb[my_697shsm]=" . urlencode(mb_convert_encoding("否", 'GB2312', 'UTF-8')); // -- deliver or not
$data[] = "postdb[my_781xf]=" . urlencode(mb_convert_encoding(mb_convert_encoding($type, 'GB2312', 'UTF-8'), 'GB2312', 'UTF-8')); // -- type
$data[] = "postdb[my_price]="; // --
$data[] = "postdb[content]=" . urlencode(mb_convert_encoding(($deal->getDetails()), 'GB2312', 'UTF-8')); // --
$data[] = "titledb[1]=";
$data[] = "photodb[1]=" . urlencode($deal->getImage());
$data[] = "photodb[2]=" . $conf['site_url'] . '/images/advertisement.jpg';
$data[] = "photodb[3]=" . $conf['site_url'] . '/images/wechat-logo-with-text.jpg';
$data[] = "local_file1=";
$data[] = "ftype[1]=out";
$data[] = "nums=1";
$data[] = $qaptcha_key . "=";
$data[] = "submit=提 交";
$data[] = "fid=23";
$data[] = "id=0";






$result = $curl->post(
        $conf['sydneytoday']['post_url'], 
        implode('&', $data),
        'http://www.sydneytoday.com/post.php?fid=23',
        true
);

// deal with error
$matches = array();
$text;
$now = time();
if (preg_match('/alert\(\'(.*)\'\);/', $result, $matches)) {
  $text = mb_convert_encoding($matches[1], 'UTF-8', 'GB2312');
  if ($text != '内容正在提交...') {
    echo $text;
    exit;
  } else {
    $instance = new SydneytodayNewproductInstance();
    $instance->setDeal($deal);
    $instance->setCreatedAt($now);
    $instance->save();
    echo $text;
    exit;
  }
} else {
  echo 'Something goes wrong...';die($result);;
}
