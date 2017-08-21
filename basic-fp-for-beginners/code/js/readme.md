## Local Setup

- Clone this repository

  ```sh
  git clone https://github.com/well1791/presentations.git
  cd presentations/basic-fp-for-beginners/code/js
  ```

- Install current stable node trough
  [nvm](https://github.com/creationix/nvm#installation)

  ```sh
  curl -o- https://raw.githubusercontent.com/creationix/nvm/v0.33.2/install.sh | bash
  nvm install node --stable
  ```

- Install [yarn](https://yarnpkg.com/en/docs/install#alternatives-tab)

  ```sh
  curl -o- -L https://yarnpkg.com/install.sh | bash
  source ~/.zhrc
  ```

  **Note:** In case you don't have a `~/.zhrc` file, use `run ~/.bashrc`
  instead.

- Install node dependencies

  ```sh
  yarn install
  ```


## Run Tests

```
yarn test
```
