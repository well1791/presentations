## Local Setup

- Clone this repository

  ```sh
  git clone https://github.com/well1791/presentations.git
  cd presentations/basic-fp-for-beginners/code/php
  ```

- Install current stable [php](http://php.net/manual/en/install.php)

- Install [composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)
  also, make sure your `$PATH` includes the `~/.local/bin` directory.
  To make sure your terminal will load that path every time, open your `.zshrc`
  or `~/.bashrc` file and append this snippet at the bottom:
  `export PATH="${HOME}/.local/bin:${HOME}/.composer/vendor/bin"`

  ```sh
  php composer-setup.php --install-dir=~/.local/bin --filename=composer
  source ~/.zshrc
  ```

- Install node dependencies

  ```sh
  composer install
  ```


## Run Tests

```
./vendor/bin/phpunit tests
```
