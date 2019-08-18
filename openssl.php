<?php
date_default_timezone_set("Asia/Taipei");
echo date("Y-m-d",strtot
ime(shell_exec("echo | openssl s_client -servername wesleylai.com -connect 183.182.77.152:443 2>/dev/null | openssl x509 -noout -issuer -subject -dates | grep notAfter | cut -d '=' -f2")));