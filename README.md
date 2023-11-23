# WooCommerce Checkout Require Coupon

Este plugin permite definir una serie de cupones necesarios para completar el pedido de determinados productos de una tienda online creada mediante el plugin WooCommerce.

Las IDs de los productos afectados deben indicarse en el array targeted_ids.

Los códigos de los cupones que permitirán realizar los pedidos deben incluirse en un fichero `codes.txt` dentro del mismo directorio del plugin, separados únicamente por un salto de línea.

Estos códigos son de un único uso y se eliminarán una vez utilizados.

## Instalación
Subir el fichero 'woocommerce-checkout-require-coupon.zip' al instalador de plugins de WordPress. Una vez instalado, añadir al fichero `codes.txt` los cupones admitidos al directorio del plugin: `wp-content/plugins/woocommerce-checkout-require-coupon`.