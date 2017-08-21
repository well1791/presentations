const findK = (n, p) => {
  const ns = String(n).split('');
  var div, mod, sum = 0;

  for (let i = 0; i < ns.length; ++i) {
    sum += Math.pow(Number(ns[i]), p + i);
  }

  div = sum / n;
  mod = sum % n;

  return mod === 0 ? div : -1;
};

module.exports = findK;
