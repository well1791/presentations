const fp = require('./lib/fp');

const sumPows = p => fp.pipe([
  String,
  fp.splitOn(''),
  fp.map(Number),
  zipWithPows(p),
  fp.map(fp.apply(Math.pow)),
  fp.sum
]);

const zipWithPows = fp.curry2((p, list) =>
  fp.zip(list, fp.range(p, p + list.length)));

const findK = (n, p) => fp.pipe([
  sumPows(p),
  fp.flip(fp.divMod)(n),
  ([div, mod]) => mod === 0 ? div : -1
])(n);

module.exports = findK;
