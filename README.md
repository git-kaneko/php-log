# Monolog

### **composer導入前提**
<br>

- ログレベル
    - debug
    - info
    - notice
    - warning
    - error
    - critical
    - alert
    - emergency

- 使い方
    1. cloneする
    2. composer install
    3. Settings.php 作成
    4. logクラス読み込み
    ```
    use myLog\Log;
    ```
    5. log出力
    ```
    Log::debug("ログメッセージ");
    ```

- Settings.php

    ```
    <?php
    namespace myLog;

    class Settings {
        const NAME = "アプリケーションの名前など";
        const PATH = "ログファイルを出力するディレクトリ";
        const FILENAME = "ログファイル名";
        /* ログの最低レベルを設定
         * 例）LEVEL=INFO 
         *     Log::DEBUG('AAA') ← 出力されない
         *     Log::INFO('BBB') ← 出力されない
         *     Log::NOTICE('CCC') ← 出力される
        */
        const LEVEL = "ログ出力レベル"; 
    }

    ?>
    ```