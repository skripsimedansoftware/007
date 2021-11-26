# Medan Software - Codeigniter Web Camera :coffee:

Klasifikasi Nilai Pasti dan Bukan Prediksi

https://rahmadya.com/2018/10/22/deteksi-warna-dengan-jarak-euclidean/

https://medium.com/bee-solution-partners/cara-kerja-algoritma-k-nearest-neighbor-k-nn-389297de543e

https://ms.annonces-tunisiennes.com/article/how_to_quantify_the_distance_between_two_colors
 - https://gist.github.com/mikelikespie/641528/7e1874d76a1bf8586c79d8a7972d8430e072733a
 http://colormine.org/convert/rgb-to-lab


Site Setting

```text
Google Chrome

chrome://settings/content/siteDetails?site=https://yoursite.ext/
chrome://settings/content/camera
```

## Note!!

- Change email config & reset password email from

## Template Loader

```php
$config = array(
	'module' => 'admin'
);
$this->load->library('template', $config);

```

### controllers/Admin.php

```php
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
	/**
	 * constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$config = array(
			'module' => 'admin'
		);
		$this->load->library('template', $config);
	}

	public function index()
	{
		$data['title'] = 'Page Title';
		$this->template->load('home', $data);
	}
}
```

### models/Admin.php

```php
<?php
/**
 * @package Codeigniter
 * @subpackage Admin
 * @category Model
 * @author Agung Dirgantara <agungmasda29@gmail.com>
 */

namespace Angeli;

class Admin extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
	}
}

/* End of file Admin.php */
/* Location : ./application/models/Admin.php */
```

### views/admin/base.php

```html
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Base</title>
</head>
<body>
<?php echo $page; ?>
</body>
</html>
```

### views/admin/home.php

```html
<div class="row">Page Content Here</div>
```