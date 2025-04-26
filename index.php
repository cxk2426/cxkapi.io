<?php
function getRandomLineFromFile($filename) {
    if (!file_exists($filename)) {
        return "文件不存在";
    }
    
    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    if (empty($lines)) {
        return "文件为空";
    }
    
    return $lines[array_rand($lines)];
}

// 定义默认的中文数组
$defaultArray = array("一言", "骚话", "安慰", "毒鸡汤", "情话", "签名", "温柔");

// 获取参数 msg
$msg = isset($_GET['msg']) 
   ? $_GET['msg'] 
    : $defaultArray[array_rand($defaultArray)]; // 若未传入则从默认数组中随机选一个

$filenameMap = array(
    "一言" => "yiyan.txt",
    "骚话" => "saohua.txt",
    "安慰" => "anwei.txt",
    "毒鸡汤" => "dujitang.txt",
    "情话" => "qinghua.txt",
    "签名" => "qianming.txt",
    "温柔" => "wenrou.txt"
);

// 构建要读取的英文文件名
$englishFilename = isset($filenameMap[$msg]) 
   ? $filenameMap[$msg] 
    : "unknown.txt";

// 获取当前目录名作为filename
$currentDirFilename = basename(__DIR__);

// 构建包含type=count的URL
$link = 'http://localhost:2426/web/count/updateCount.php?filename='. urlencode($currentDirFilename). '&type=count';
@file_get_contents($link);

$countUrl = 'http://localhost:2426/web/count/record_call.php';
@file_get_contents($countUrl);

// 获取随机文本并输出
$randomText = getRandomLineFromFile($englishFilename);
echo $randomText;
?>
