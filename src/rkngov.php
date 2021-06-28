<?php
 $vk = json_decode(file_get_contents("https://api.vk.com/method/wall.get?domain=rpngov&count=2&filter=owner&v=5.131&access_token=40bd9ce140bd9ce140bd9ce13a40e225a1440bd40bd9ce12064a022fa39bfb64b82cf24"));
$count = 0;
foreach($vk->response->items as $item){
    if(!isset($item->is_pinned)){
        $txt_arr = explode('.', $item->text);
        $title = $txt_arr[0];
        if(isset($item->attachments) && isset($item->attachments[0]->photo) && $count < 1){
            $size = end($item->attachments[0]->photo->sizes);
            $src_url = $size->url;
            $parts = parse_url($src_url);
            $clean_url = $parts['scheme']."://".$parts['host'].$parts['path'];
            $img_data = file_get_contents($src_url);
            $uri_arr = explode('.', $clean_url);
            $ext = end($uri_arr);
            $img = '<img alt="Росприроды информирует"  src="data:image/'.$ext.';base64,'.base64_encode($img_data).'">';
            $date = date('Y-m-d', $item->date);
            $fileName = '../_posts/'.$date.'-'.$item->id.'.md';
$md = <<<EOD
---
layout: post
title: $title
category: news
---

EOD;

            $md .= $item->text."<!--more-->\n\n".$img;
        file_put_contents($fileName, $md);


            $count++;
        }
    }


}
?>
