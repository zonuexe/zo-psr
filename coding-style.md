# コーディングスタイル

[PSR-2: Coding Style Guide - PHP-FIG][PSR-2]([日本語訳][PSR-2.ja])に準拠する。

ただし、以下の項目についてPSR-2を上書きする。

## 1. 概要

 * インデントにはタブを使用し、幅8文字での表示を基本とします。
 * クラスの開き括弧は同じ行に記述しなければなりません。また閉じ括弧は本文最後の次の行に記述しなければなりません。
 * メソッドの開き括弧は同じ行に記述しなければなりません。また閉じ括弧は本文最後の次の行に記述しなければなりません。

### 1.1. 例

以下は、概要内容を適用した例です。

```php
<?php
namespace Vendor\Package;

use FooInterface;
use BarClass as Bar;
use OtherVendor\OtherPackage\BazClass;

class Foo extends Bar implements FooInterface {
	public function sampleFunction($a, $b = null) {
		if ($a === $b) {
			bar();
		} elseif ($a > $b) {
			$foo->bar($arg1);
		} else {
			BazClass::bar($arg2, $arg3);
		}
	}

	final public static function bar() {
		// メソッド本文
	}
}
```

## 2. 一般

### 2.4. インデント

インデントにはタブ文字(`\t`)を使用し、8文字での表示を基本とする。サブインデントには必ず行頭からタブ文字を使用し、8文字に満たない調節にはスペースを用いる。

## 4. クラス、プロパティ及びメソッド

### 4.1. ExtendsとImplements

`extends` と `implements` は、クラス名と同じ行で定義されなけれなりません。

クラスの開き括弧は同じ行に記述しなければなりません。また、一行が長い場合も複数行に分割しません。

```php
<?php
namespace Vendor\Package;

use FooClass;
use BarClass as Bar;
use OtherVendor\OtherPackage\BazClass;

class ClassName extends ParentClass implements \ArrayAccess, \Countable {
    // constants, properties, methods
}
```

### 4.2. プロパティ

プロパティ名に、`protected` または `private` を示すためにシングルアンダースコアを使用しなければなりません。

具体的なプロパティ定義は下記のようになります。

```php
<?php
namespace Vendor\Package;

class ClassName
{
    private $_foo;
}
```

### 4.3. メソッド

メソッド名の後ろに1つのスペースを使用し、開き括弧は定義開始行に記述しなければなりません。

返り値の型宣言を記述する場合は引数リストの直後に `:` とスペース1つを配置します。

メソッド定義は下記のようになります。 括弧、カンマ、スペースの位置に注意してください。

```php
<?php
namespace Vendor\Package;

class ClassName {
    public function fooBarBaz($arg1, &$arg2, $arg3 = []) {
        // method body
    }

    public function piyo($arg1): ?ClassName {
        // method body
    }
}
```

[PSR-2]: https://www.php-fig.org/psr/psr-2/
[PSR-2.ja]: http://www.infiniteloop.co.jp/docs/psr/psr-2-coding-style-guide.html
