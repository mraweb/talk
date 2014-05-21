<?php
/*
 * Class UploadImage
 * @param $image = Name or Array with name of the image
 * @param $image_tmp = Name or Array with name temp of the image temp
 * @param $type_erros = Types "Exception"(default), "Return", "Exit"
 *
 * Date of creation: 06-02-2011 12:40:50 AM
 * Create by: Euco Vidal - euricovidal@hotmail.com - www.ividal.net
 */
class UploadImage{
    public $to_dir = 'thumb/';
    public $new_width = 133;
    public $set_prefix;
    public $set_sufix;
    public $separator = '_';
    public $replaces = array();
    public $type_errors = 'Exception';
    private $file;
    private $tmp_file;
    private $mime_type;
    private $msg_error;

    public function __construct($image = null, $image_tmp = null, $type_errors = false){
        if($type_errors) $this->type_errors = $type_errors;
        if(is_null($image)){
            $this->error('File does not exists');
        } else{
            $this->tmp_file_name = $image;
            $this->setName();
            //$this->setTmpName($image_tmp ?: $image);
            $this->setTmpName($image_tmp ? $image_tmp : $image); 
            $this->setMimeType($image);
        }
    }

    public function make_name(){  
        return $this->setName();
    }

    public function getError(){
        return $this->msg_error;
    }

    public function generate(){
        if($this->validate()){
            if($this->verifyDir()){
                $this->compile();
                return true;
            } else $this->error('Dont exists directory');
        } else $this->error('File is not format valid');
    } 

    private function setName(){
        $image = $this->tmp_file_name;
        if(isset($image['name'])){
            $file = md5($image['name']).".jpg";
        } elseif(is_string($image)){
            $file = md5($image).".jpg";
        } else{
            $this->error('Name does not found');
        }
        $prefix = $this->set_prefix;// ? $this->set_prefix . $this->separator : null;
        $sufix = $this->set_sufix; // ? $this->separator . $this->set_sufix : null;
        $file = (string) strtolower($prefix ."_". $sufix ."_". $file );
        foreach($this->replaces as $from => $to){
            $file = str_replace($from, $to, $file);
        }
        $this->file = (string) strtolower($file);
        return $this->file;
    }

    private function setTmpName($image){
        if(isset($image['tmp_name'])){
            $this->tmp_file = $image['tmp_name'];
        } elseif(is_string($image)){
            $this->tmp_file = $image;
        } else{
            $this->error('Temp name does not found');
        }
    }

    private function setMimeType($image){
        if(isset($image['type'])){
            $this->mime_type = $image['type'];
        }
    }

    private function validate(){
        if($this->mime_type){
            if(preg_match('/^image\/(pjpeg|jpeg|png|git|bmp|gif)$/i', $this->mime_type)){
                return true;
            } else $this->error('Format is not valid');
        } else $this->error('Mime-type is not defined');
    }

    private function verifyDir(){
        if(is_dir($this->to_dir)) return true;
        else return false;
    }

    private function compile(){
        $img = imagecreatefromstring(file_get_contents($this->tmp_file));
        list($width, $height) = getimagesize($this->tmp_file);
        if($width > $this->new_width){
            $new_height = ($this->new_width / $width) * $height;
            $thumb = imagecreatetruecolor($this->new_width, $new_height);
            imagecopyresampled($thumb, $img, 0, 0, 0, 0, $this->new_width, $new_height, $width, $height);
            imagejpeg($thumb, $this->to_dir . $this->file, 100);
        } else{
            copy($this->tmp_file, $this->to_dir . $this->file);
        }
    }

    private function error($msg = 'Error'){
        if($this->type_errors == 'Exception'){
            throw new Exception($msg);
        } elseif($this->type_errors == 'Return'){
            $this->msg_error = $msg;
            return true;
        } else{
            exit($msg);
        }
    }
}
?>
