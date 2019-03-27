# item-list-display
> An abstract PHP script to display stuff on your website.

## Usage
Initialize an instance.
```
$content = new \Xandrucea\ItemListDisplay\ItemListDisplay();
```

You can provide additional configuration in an __array__.
```
$config = [
  'contentDirectory'  => 'content/',
  'templateDirectory' => 'templates/',
  'itemKey'           => 'blog'
];
$content = new \Xandrucea\ItemListDisplay\ItemListDisplay($config);
```

Render the content.
```
$content->render();
```

## Get started
```
git clone https://github.com/xandrucea/item-list-display.git

composer install

composer run start
```

## Contributing
WIP

## License
Copyright © 2019 [Alex Cio](https://github.com/xandrucea/) / info@alex-cio.de. Licensed under the terms of the [MIT license](LICENSE).
