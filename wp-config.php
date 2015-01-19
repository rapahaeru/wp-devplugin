<?php
/** 
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'db_curso');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', 'root');

/** nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Ek=L8Z+,5W{&woy6}Z?j-THukt[LG+Y4h#]>TGs2|%zhl#Ol||WsJxr^={L_$n~b');
define('SECURE_AUTH_KEY',  'KgP-pC~oY%P!~/4~)Cogl&vm!1;S}4ld*i!1Z:(X5m0,]&-}_EQVXT:q|!+#QSr-');
define('LOGGED_IN_KEY',    'vGM-V[^uvQ0([+#0zU`*?DnAX495ZE,B/}K=b+-]CI2M:RR9ILw$d;{L0h#UPGk:');
define('NONCE_KEY',        '@4s?Nlt;;JQ2(*)PIY)E07+weLT}_qDlfVbbu+_|GftNvoR88?s{ T}lsGD=}ix2');
define('AUTH_SALT',        'j|TkTi>%=a$Rj]*E/fRj$/F89U9i!KE?<4is$GWlpGo&5RA6AQa7.5nA|;hn.J1l');
define('SECURE_AUTH_SALT', 'Y9}>hFEZ:[kQn4`;L$N?R-<{%ROL1ULBEM{CC]=]]:IN(M{Op1Pz=[9L` zI1:g%');
define('LOGGED_IN_SALT',   'r_* -p4`WIz0cD}.)_jgZz@N,}hS%k&4/|j>XJeUJ`x!-K;JN>cFS=K-jL]l}t+$');
define('NONCE_SALT',       '>AQ`*_o_,$9Ou202`@?1$)}je%Qj<&tQ^iYQEJQT#Q<n-@by? mGvUNXw/vBltr=');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wpcurso_';

/**
 * O idioma localizado do WordPress é o inglês por padrão.
 *
 * Altere esta definição para localizar o WordPress. Um arquivo MO correspondente ao
 * idioma escolhido deve ser instalado em wp-content/languages. Por exemplo, instale
 * pt_BR.mo em wp-content/languages e altere WPLANG para 'pt_BR' para habilitar o suporte
 * ao português do Brasil.
 */
define('WPLANG', 'pt_BR');

/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
