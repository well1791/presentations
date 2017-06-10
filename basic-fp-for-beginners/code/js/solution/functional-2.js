const fp = require('sanctuary');

const sumPows = p => fp.pipe([
  String,
  fp.splitOn(''),
  fp.map(Number),
  fp.map(fp.curry2(Math.pow)),
  fp.reduce(applyPows(p), []),
  fp.sum
]);

const applyPows = p => fp.curry2((list, f) =>
  fp.prepend(f(p + list.length), list));

const findK = (n, p) => fp.pipe([
  sumPows(p),
  fp.flip(divMod)(n),
  ([div, mod]) => mod === 0 ? div : -1
])(n);

module.exports = findK;

// General available function
const divMod = fp.curry2((a, b) => b === 0
  ? new Error('Cannot divide by zero')
  : [a / b, a % b]);
