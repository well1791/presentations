# Exercise: Funny Properties


## Local Setup

- Clone this repository

  ```sh
  git clone https://github.com/well1791/presentations.git \
  cd presentations/basic-fp-for-beginners/
  ```

- Install current stable node trough
  [nvm](https://github.com/creationix/nvm#installation)

  ```sh
  curl -o- https://raw.githubusercontent.com/creationix/nvm/v0.33.2/install.sh | bash \
  nvm install node --stable
  ```

- Install [yarn](https://yarnpkg.com/en/docs/install#alternatives-tab)

  ```sh
  curl -o- -L https://yarnpkg.com/install.sh | bash \
  source ~/.zhrc
  ```

  **Note:** In case you don't have a `~/.zhrc` file, use `run ~/.bashrc`
  instead.

- Install node dependencies

  ```sh
  yarn install
  ```


## Description

Given a positive number `n`, and a positive integer `p`; we want to find
a positive integer `k`, if exists.  So the sum of the digits of `n` taken
to the successive powers of `p` is equal to `n * k`.

In other words, there exists an integer `k` such as:

> a^p + b^(p+1) + c^(p+2) + d^(p+3) + ... = (abcd...) * k

If it is the case it will return `k`, if not it returns `-1`.

**Note:** `n`, `p` will always be given as strictly positive integers


## Examples

In a pair `(n, p)`; `n` is the number, and `p` is the power.

Working cases:


```
         ↱    8¹ + 9²   ↘
   (89, 1)               80
         ↳ 89 × (k ← 1) ↗


         ↱  6² + 9³ + 5⁴ ↘
  (695, 2)                1390
         ↳ 695 × (k ← 2) ↗


         ↱ 4³ + 6⁴ + 2⁵ + 8⁶ + 8⁷ ↘
(46288, 3)                         2360688
         ↳   46288 × (k ← 51)     ↗
```


Error case:

```
      ↱    9¹ + 2²   ↘
(92, 1)               13
      ↳ 92 × (k ← ?) ↗
```

There is no number multiplied by `92` which give us `13`,
so for this case `k` would be `-1` instead of `?`


## Run Tests

```
yarn test
```
