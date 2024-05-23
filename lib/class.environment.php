<?php 

class DotEnvironment {
    private $path;
    private $tmp_env;
    function __construct(){
        $this->path = __DIR__.'/../';
        // echo $this->path;
        // exit;

        //Check .envenvironment file exists
        if(!is_file(realpath($this->path.'/.env'))){
            throw new ErrorException("Environment File is Missing.");
        }
        //Check .envenvironment file is readable
        if(!is_readable(realpath($this->path.'/.env'))){
            throw new ErrorException("Permission Denied for reading the ".(realpath($this->path.'/.env')).".");
        }
        $this->tmp_env = [];
        $fopen = fopen(realpath($this->path.'/.env'), 'r');
        if($fopen){
            while (($line = fgets($fopen)) !== false){
                // Check if line is a comment
                $line_is_comment = (substr(trim($line),0 , 1) == '#') ? true: false;
                if($line_is_comment || empty(trim($line)))
                    continue;

                $line_no_comment = explode("#", $line, 2)[0];
                $env_ex = preg_split('/(\s?)\=(\s?)/', $line_no_comment);
                $env_name = trim($env_ex[0]);
                $env_value = isset($env_ex[1]) ? trim($env_ex[1]) : "";
                $this->tmp_env[$env_name] = $env_value;
            }
            fclose($fopen);
        }
    }

    function load(){
        // Save .env data to Environment Variables
        foreach($this->tmp_env as $name=>$value){
            putenv("{$name}=$value");
            if(is_numeric($value))
            $value = floatval($value);
            if(in_array(strtolower($value),["true","false"]))
            $value = (strtolower($value) == "true") ? true : false;
            $_ENV[$name] = $value;
        }
        // print_r(realpath($this->path.'/.env'));
    }
    function update_env_variables($vars = []){
        //Check .envenvironment file exists
        if(!is_file(realpath($this->path.'/.env'))){
            throw new ErrorException("Environment File is Missing.");
        }
        //Check .envenvironment file is readable
        if(!is_readable(realpath($this->path.'/.env'))){
            throw new ErrorException("Permission Denied for reading the ".(realpath($this->path.'/.env')).".");
        }
        //Check .envenvironment file is writable
        if(!is_writable(realpath($this->path.'/.env'))){
            throw new ErrorException("Permission Denied for writing on ".(realpath($this->path.'/.env')).".");
        }
        $fopen = fopen(realpath($this->path.'/.env'), 'r');
        $new_content = "";
        $i =1;
        if($fopen){
            while (($line = fgets($fopen)) !== false){
                $line_num = $i++;
                if($line_num > 1)
                $new_content .="\n";
                // Check if line is a comment
                $line_is_comment = (substr(trim($line),0 , 1) == '#') ? true: false;
                if($line_is_comment || empty(trim($line))){
                    $new_content .= trim($line,"\r\n");
                    continue;
                }
                $line_ex = explode("#", $line, 2);
                $line_no_comment = $line_ex[0];
                $env_ex = preg_split('/(\s?)\=(\s?)/', $line_no_comment);
                $env_name = trim($env_ex[0]);
                $env_value = isset($env_ex[1]) ? trim($env_ex[1]) : "";
                if(!isset($vars[$env_name])){
                    $new_content .= trim($line,"\r\n");
                }else{
                    $new_line = "{$env_name} = ";
                    $new_line .= $vars[$env_name]." ";
                    if(isset($line_ex[1]))
                    $new_line .= "#".trim($line_ex[1],"\r\n");

                    $new_content .= $new_line;
                }
            }
            fclose($fopen);
        }
        // return str_replace('/\n/',"<br>", $new_content);
        $update_env_file = file_put_contents(realpath($this->path.'/.env'), $new_content);
        return true;
    }
}

$__DotEnvironment = new DotEnvironment();
$__DotEnvironment->load();
?>