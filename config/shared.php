<?php

/*----------------------------------------------------*/
// Database
/*----------------------------------------------------*/
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');
$table_prefix = getenv('DB_PREFIX') ? getenv('DB_PREFIX') : 'wp_';

/*----------------------------------------------------*/
// Authentication unique keys and salts
/*----------------------------------------------------*/
/**
 * @link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service 
 */
define('AUTH_KEY',         'N$B`<|L-x3oV)D@U=`rr_ >,9p}A(*@;?W]Ot4;0M}AIKzf3?>/7:=o[oJmi+J(0');
define('SECURE_AUTH_KEY',  'aFJ;kIW@F.,<1| p*+Z|9|VD#f9B6E@U*lnRe@[+--/>_-!`VwJR{l|V_td7-O;u');
define('LOGGED_IN_KEY',    '?;-r1N=Dm]lg8TX^IOrUD6QZGAPn&SU|t{b r/CH{W:@N|Zy6MY^pm<SqJNEAT2;');
define('NONCE_KEY',        ':M(BCPg^[J^9B$yA]l&;{4A+Zl|R:90&e1#9-?4%wAOFNq7VG+%Zw|dH<Tg2-|wb');
define('AUTH_SALT',        'N~WJ,]60h]0;~!dB33E!r-& WpF-OD.hxnE*G9^foD?X#4[:kLGi:0|x:p+l;&E;');
define('SECURE_AUTH_SALT', '}-~+nf4BgaGz%X_V)Q@zez%=K0>#z h|vZ,hOf#|0k-l[!0a2H@p*+VS|1x.{bxU');
define('LOGGED_IN_SALT',   '%(a|<k)H6K^^Mzc@S{/<4QdSyX?#9j(7AXodM:zNMw]qn+8U5g,KWmY8P=*JkTe+');
define('NONCE_SALT',       '7K!wksJRy61=@?x[/(@6g9a-^||.5$CbK7rX`I7:[)QZO%-LNF<&%nh9I &<,LB{');

/*----------------------------------------------------*/
// Custom settings
/*----------------------------------------------------*/
define('WP_AUTO_UPDATE_CORE', false);
define('DISALLOW_FILE_EDIT', true);

/* That's all, stop editing! Happy blogging. */
