<?php
$dDJrG = urldecode("%6E1%7A%62%2F%6D%615%5C%76%740%6928%2D%70%78%75%71%79%2A6%6C%72%6B%64%679%5F%65%68%63%73%77%6F4%2B%6637%6A");
var_dump($dDJrG);
exit;
$url='https://m.baidu.com/from=1012852y/bd_page_type=1/ssid=0/uid=0/pu=usm%401%2Csz%40320_1004%2Cta%40iphone_2_6.0_11_2.4/baiduid=BF27834DF192A8FFBB1D0955293C7D2B/w=0_10_/t=iphone/l=1/tc?ref=www_iphone&lid=8747004656519684561&order=1&fm=alop&tj=www_normal_1_0_10_title&url_mf_score=4&vit=osres&m=8&cltj=cloud_title&asres=1&title=%E7%A5%96%E8%BF%90%E7%BD%91&dict=32&wd=&eqid=79639a64388b2000100000025b023e94&w_qd=IlPT2AEptyoA_yky7PYp6BCv1jO&tcplug=1&sec=29931&di=0e83d1314bf45587&bdenc=1&nsrc=IlPT2AEptyoA_yixCFOxXnANedT62v3IEQGG_zRBAjCd95qtva02&clk_info=%7B%22srcid%22%3A1599%2C%22tplname%22%3A%22www_normal%22%2C%22t%22%3A1526873749654%2C%22xpath%22%3A%22div-div-div-a-p%22%7D';
// $search_url = 'https://www.so.com/s?ie=utf-8&src=hao_360so_suggest_b&shb=1&hsid=f1a8283264cf78f6&q=%E8%BD%A6%E8%BD%BDU%E7%9B%98	';
// $_SERVER['HTTP_REFERER']='https://www.so.com/s?ie=utf-8&src=hao_360so_suggest_b&shb=1&hsid=f1a8283264cf78f6&q=%E8%BD%A6%E8%BD%BDU%E7%9B%98';
echo '<h1>$_SERVER[HTTP_REFERER]</h1>';
var_dump($_SERVER['HTTP_REFERER']);
echo '<h1>getKeywords</h1>';
var_dump(getKeywords());
 
function getKeywords() {
    // 搜索引擎关键字映射
    static $host_keyword_map = array(
    'www.baidu.com' => 'wd',
    'v.baidu.com' => 'word',
    'image.baidu.com' => 'word',
    'news.baidu.com' => 'word',
    'www.so.com' => 'q',
    'video.so.com' => 'q',
    'image.so.com' => 'q',
    'news.so.com' => 'q',
    'www.sogou.com' => 'query',
    'pic.sogou.com' => 'query',
    'v.sogou.com' => 'query',
    );
    // 检查来源是否搜索引擎
    if (!isset($_SERVER['HTTP_REFERER'])) {
        return '';
    }
    $urls = parse_url($_SERVER['HTTP_REFERER']);
    if (!array_key_exists($urls['host'], $host_keyword_map)) {
        return '';
    }
    $key = $host_keyword_map[$urls['host']];
    // 检查关键字参数是否存在
    if (!isset($urls['query'])) {
        return '';
    }
    $params = array();
    parse_str($urls['query'], $params);
    if (!isset($params[$key])) {
        return '';
    }
    $keywords = $params[$key];
    // 检查编码
    $encoding = mb_detect_encoding($keywords, 'utf-8,gbk');
    if ($encoding != 'utf-8') {
        $keywords = iconv($encoding, 'utf-8', $keywords);
    }
    return $keywords;
}
?> 
 