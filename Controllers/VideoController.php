<?php

class VideoController
{
    public function makevideo($gencode,$name,$input){
        if ($gencode != 'swrgf3'){
            return;
        }
        
        
        exec('ffprobe -i /var/www/html/sys/upload/temp/'.$input.' -show_entries format=duration -v quiet -of csv="p=0"', $ret, $return_var);
        $one = round($ret[0]*0.25);
        mkdir ("/var/www/html/sys/upload/files/$name");
        
        shell_exec('ffmpeg -hide_banner -y -i /var/www/html/sys/upload/temp/'.$input.' -ss '.$one.' -qscale:v 4 -frames:v 1 /var/www/html/sys/upload/files/'.$name.'/poster.jpg 2>&1 &> /dev/null &');
        
        shell_exec('ffmpeg -hide_banner -y -i /var/www/html/sys/upload/temp/'.$input.' -crf 20 -sc_threshold 0 -g 48 -keyint_min 48 -ar 48000   -map 0:v:0 -map 0:v:0 -map 0:v:0 -map 0:a:0 -map 0:a:0 -map 0:a:0   -c:v:0 h264 -profile:v:0 main -filter:v:0 "scale=w=842:h=480:force_original_aspect_ratio=decrease" -b:v:0 1400k -maxrate:v:0 1498k -bufsize:v:0 2100k   -c:v:1 h264 -profile:v:1 main -filter:v:1 "scale=w=1280:h=720:force_original_aspect_ratio=decrease" -b:v:1 2800k -maxrate:v:1 2996k -bufsize:v:1 4200k   -c:v:2 h264 -profile:v:2 main -filter:v:2 "scale=w=1920:h=1080:force_original_aspect_ratio=decrease" -b:v:2 2800k -maxrate:v:2 5350k -bufsize:v:2 7500k   -c:a:0 aac -b:a:0 96k   -c:a:1 aac -b:a:1 128k   -c:a:2 aac -b:a:2 192k   -var_stream_map "v:0,a:0 v:1,a:1 v:2,a:2" -f hls -master_pl_name '.$name.'-master.m3u8 -hls_time 10 -hls_playlist_type vod -hls_list_size 0  -hls_segment_filename upload/files/'.$name.'-v%v/'.$name.'%03d.ts upload/files/'.$name.'-v%v/'.$name.'.m3u8 1> "upload/files/'.$name.'.txt" 2>&1 &> /dev/null &');

        shell_exec('ffmpeg -hide_banner -y -i /var/www/html/sys/upload/temp/'.$input.' -q:v 4 -profile:v baseline -level 3.0 -s 800x480 -start_number 0 -hls_time 10 -hls_list_size 0 -threads 5 -preset ultrafast -f hls "/var/www/html/sys/upload/files/'.$name.'/480.m3u8" 1> "/var/www/html/sys/upload/files/'.$name.'/1.txt" 2>&1 &> /dev/null &');
        shell_exec('ffmpeg -hide_banner -y -i /var/www/html/sys/upload/temp/'.$input.' -q:v 4 -profile:v baseline -level 3.0 -s 1280x720 -start_number 0 -hls_time 10 -hls_list_size 0 -threads 5 -preset ultrafast -f hls /var/www/html/sys/upload/files/'.$name.'/720.m3u8 1> "/var/www/html/sys/upload/files/'.$name.'/2.txt" 2>&1 &> /dev/null &');
        shell_exec('ffmpeg -hide_banner -y -i /var/www/html/sys/upload/temp/'.$input.' -q:v 4 -profile:v baseline -level 3.0 -s 1920x1080 -start_number 0 -hls_time 10 -hls_list_size 0 -threads 5 -preset ultrafast -f hls /var/www/html/sys/upload/files/'.$name.'/1080.m3u8 1> "/var/www/html/sys/upload/files/'.$name.'/3.txt" 2>&1 &> /dev/null &');
        
        $m3u8 = '#EXTM3U
#EXT-X-STREAM-INF:BANDWIDTH=750000,RESOLUTION=854x480
480.m3u8
#EXT-X-STREAM-INF:BANDWIDTH=2000000,RESOLUTION=1280x720
720.m3u8
#EXT-X-STREAM-INF:BANDWIDTH=3500000,RESOLUTION=1920x1080
1080.m3u8';
        $filename = "/var/www/html/sys/upload/files/$name/master.m3u8";

        $fh = fopen($filename, 'w');
        fwrite($fh, $m3u8);
        fclose($fh);
        
                
        exec('pidof ffmpeg', $output, $return_var);
        
        shell_exec('cpulimit -p '.$output[0].' -l 70');
        shell_exec('prlimit --pid '.$output[0].' --as=512000000');
    }
    
    public function getprogress($file){
        if (gettype($this->getfileprogress($file,1)) == 'double'){
            $onepr = $this->getfileprogress($file,1);
        } else {
            $onepr = 100;
        }
        if (gettype($this->getfileprogress($file,2)) == 'double'){
            $twopr = $this->getfileprogress($file,2);
        } else {
            $twopr = 100;
        }
        if (gettype($this->getfileprogress($file,3)) == 'double'){
            $treepr = $this->getfileprogress($file,3);
        } else {
            $treepr = 100;
        }
        $procent = round(($onepr+$twopr+$treepr)/3);
        if ($procent == 100){
            return $this->getfileprogress($file,3);
        } else {
            echo $procent;
        }
    }
    
    
    private function getfileprogress($file,$numtxt){
        $content = @file_get_contents('/var/www/html/sys/upload/files/'.$file.'/'.$numtxt.'.txt');
        
        if($content){
            //get duration of source
            preg_match("/Duration: (.*?), start:/", $content, $matches);

            $rawDuration = $matches[1];

            //rawDuration is in 00:00:00.00 format. This converts it to seconds.
            $ar = array_reverse(explode(":", $rawDuration));
            $duration = floatval($ar[0]);
            if (!empty($ar[1])) $duration += intval($ar[1]) * 60;
            if (!empty($ar[2])) $duration += intval($ar[2]) * 60 * 60;

            //get the time in the file that is already encoded
            preg_match_all("/time=(.*?) bitrate/", $content, $matches);

            $rawTime = array_pop($matches);

            //this is needed if there is more than one match
            if (is_array($rawTime)){$rawTime = array_pop($rawTime);}

            //rawTime is in 00:00:00.00 format. This converts it to seconds.
            $ar = array_reverse(explode(":", $rawTime));
            $time = floatval($ar[0]);
            if (!empty($ar[1])) $time += intval($ar[1]) * 60;
            if (!empty($ar[2])) $time += intval($ar[2]) * 60 * 60;

            //calculate the progress
            $progress = round(($time/$duration) * 100);
            
            preg_match("/, from '(.*?)':/", $content, $name);
            
            
            preg_match_all("/video:(.*?) audio:/", $content, $matches);
            if ($matches[0]){
                return array($duration, $file,$name[1]);
            } else {   
                return $progress;
            }

        }
    }
    
    
    public function takeScreen($dur){
        $namefile = $dur[1];
        $input = $dur[2];
        $dur = $dur[0];
        $one = round($dur*0.25);
        $two = round($dur*0.5);
        $tree = round($dur*0.75);
        if (file_exists('upload/files/'.$namefile.'/poster.jpg')) {
        } else {
            shell_exec('ffmpeg -hide_banner -y -i '.$input.' -ss '.$one.' -qscale:v 4 -frames:v 1 upload/files/'.$namefile.'/poster.jpg 2>&1 &> /dev/null &');
        }

         
    }
    
    public function generateName($length = 8) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);

        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }

        return md5($result.time());
    }
}
?>