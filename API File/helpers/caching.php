<?php
namespace helpers;


/**
 * 
 * Caches results
 */
class caching {

    private $cachetime = 10;
    private $cachFile;
    private $cachPath="caches/";

    /**
     * Checks if any cached output for exact request exists to returns that
     * Othervice creates a new cach file
     * 
     * I can create more complex caching method, for example, creating a sub-table 
     * of most requested * APIs but for this small data I thought that it should be
     */
    public function start($sections){
        $this->deleteCaches();
        $this->cachFile = $this->cachPath."cache-".implode("-",$sections[0])."-".implode("-",$sections[1]).".html";
        if (file_exists($this->cachFile) && time() - $this->cachetime < filemtime($this->cachFile)) {
            header('Content-Type: application/json');
            readfile($this->cachFile);
            exit;
        }
        ob_start();
    }

    /**
     * Save output in case of new chachin file
     */
    public function end(){
        $cached = fopen($this->cachFile, 'w');
        fwrite($cached, ob_get_contents());
        fclose($cached);
        ob_end_flush();
    }

    /**
     * deletes old cach files
     */

    public function deleteCaches(){
        $files = glob($this->cachPath."*.html");
        $now   = time();

        foreach ($files as $file) {
            if (is_file($file)) {
                if ($now - filemtime($file) >= $this->cachetime) { // 2 days
                    unlink($file);
                }
            }
        }
    }

}
?>