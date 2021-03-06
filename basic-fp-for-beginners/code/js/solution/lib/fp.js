const fp = {};

const curryN = (n, f) => (...args) => args.length < n
  ? curryN(n, f).bind(null, ...args)
  : f(...args); // => f.apply(null, args);

fp.head = xs => xs.length === 0
  ? new Error('Cannot operate on an empty List')
  : xs[0];

fp.tail = xs => xs.length === 0
  ? new Error('Cannot operate on an empty List')
  : xs.slice(1);

fp.cons = curryN(2, (x, xs) => [].concat(x, xs));
fp.prepend = fp.cons;

fp.range = curryN(2, (from, to) => from >= to
  ? []
  : fp.prepend(from, fp.range(from + 1, to)));

fp.map = curryN(2, (f, xs) => xs.length === 0
  ? []
  : fp.prepend(f(fp.head(xs)), fp.map(f, fp.tail(xs))));

fp.zip = curryN(2, (xs, ys) => {
  if (xs.length !== ys.length) {
    return new Error('Lists have different lengths');
  }
  return xs.length === 0
    ? []
    : fp.prepend(
      [[fp.head(xs), fp.head(ys)]],
      fp.zip(fp.tail(xs), fp.tail(ys))
    );
});

fp.foldr = curryN(3, (f, z, xs) => xs.length === 0
  ? z
  : f(fp.head(xs), fp.foldr(f, z, fp.tail(xs))));

fp.foldl = curryN(3, (f, z, xs) => xs.length === 0
  ? z
  : fp.foldl(f, f(z, fp.head(xs)), fp.tail(xs)));
fp.reduce = fp.foldl;

fp.pipe = fs => arg => fp.foldl(fp.T, fp.head(fs)(arg), fp.tail(fs));

fp.add = curryN(2, (a, b) => a + b);

fp.sum = fp.foldr(fp.add, 0);

fp.splitOn = curryN(2, (expr, str) => str.split(expr));

fp.flip = f => curryN(2, (a, b) => f(b, a));

fp.curry2 = f => curryN(2, f);

fp.T = curryN(2, (arg, f) => f(arg));
fp.A = curryN(2, (f, arg) => f(arg));

fp.apply = curryN(2, (f, args) => f.apply(f, args));

fp.divMod = curryN(2, (a, b) => b === 0
  ? new Error('Cannot divide by zero')
  : [a / b, a % b]);

module.exports = fp;
