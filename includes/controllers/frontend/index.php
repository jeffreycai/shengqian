<?php
global $conf;

$html = new HTML();
$html->renderOut('frontend/html_header', array('title' => 'Homepage'));

$html->renderOut('frontend/nav/main', array(
    'current_url' => get_cur_page_url(true),
    'site_name' => $conf['site_name'],
    'categories' => $conf['category']
));
$html->renderOut('frontend/sidemenu');

$html->output('<p>fds sdfsd dfs fd fds fd sfd sf dsdfs fd s fds fd sf ds fds f dsf sd fd sf ds fds ffdsfdsf dsfdsf sdfdsfds dsfsdfsd sdfsdfds</p>');
$html->output('<p>fds sdfsd dfs fd fds fd sfd sf dsdfs fd s fds fd sf ds fds f dsf sd fd sf ds fds ffdsfdsf dsfdsf sdfdsfds dsfsdfsd sdfsdfds</p>');
$html->output('<p>fds sdfsd dfs fd fds fd sfd sf dsdfs fd s fds fd sf ds fds f dsf sd fd sf ds fds ffdsfdsf dsfdsf sdfdsfds dsfsdfsd sdfsdfds</p>');
$html->output('<p>fds sdfsd dfs fd fds fd sfd sf dsdfs fd s fds fd sf ds fds f dsf sd fd sf ds fds ffdsfdsf dsfdsf sdfdsfds dsfsdfsd sdfsdfds</p>');
$html->output('<p>fds sdfsd dfs fd fds fd sfd sf dsdfs fd s fds fd sf ds fds f dsf sd fd sf ds fds ffdsfdsf dsfdsf sdfdsfds dsfsdfsd sdfsdfds</p>');
$html->output('<p>fds sdfsd dfs fd fds fd sfd sf dsdfs fd s fds fd sf ds fds f dsf sd fd sf ds fds ffdsfdsf dsfdsf sdfdsfds dsfsdfsd sdfsdfds</p>');
$html->output('<p>fds sdfsd dfs fd fds fd sfd sf dsdfs fd s fds fd sf ds fds f dsf sd fd sf ds fds ffdsfdsf dsfdsf sdfdsfds dsfsdfsd sdfsdfds</p>');
$html->output('<p>fds sdfsd dfs fd fds fd sfd sf dsdfs fd s fds fd sf ds fds f dsf sd fd sf ds fds ffdsfdsf dsfdsf sdfdsfds dsfsdfsd sdfsdfds</p>');
$html->output('<p>fds sdfsd dfs fd fds fd sfd sf dsdfs fd s fds fd sf ds fds f dsf sd fd sf ds fds ffdsfdsf dsfdsf sdfdsfds dsfsdfsd sdfsdfds</p>');
$html->output('<p>fds sdfsd dfs fd fds fd sfd sf dsdfs fd s fds fd sf ds fds f dsf sd fd sf ds fds ffdsfdsf dsfdsf sdfdsfds dsfsdfsd sdfsdfds</p>');
$html->output('<p>fds sdfsd dfs fd fds fd sfd sf dsdfs fd s fds fd sf ds fds f dsf sd fd sf ds fds ffdsfdsf dsfdsf sdfdsfds dsfsdfsd sdfsdfds</p>');
$html->output('<p>fds sdfsd dfs fd fds fd sfd sf dsdfs fd s fds fd sf ds fds f dsf sd fd sf ds fds ffdsfdsf dsfdsf sdfdsfds dsfsdfsd sdfsdfds</p>');
$html->output('<p>fds sdfsd dfs fd fds fd sfd sf dsdfs fd s fds fd sf ds fds f dsf sd fd sf ds fds ffdsfdsf dsfdsf sdfdsfds dsfsdfsd sdfsdfds</p>');

$html->renderOut('frontend/html_footer');
