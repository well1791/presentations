const findK = require('../solution/imperative');

describe('Imperative solution', () => {
  it('returns 1', () => {
    expect(findK(89, 1)).toBe(1);
  });

  it('returns 2', () => {
    expect(findK(695, 2)).toBe(2);
  });

  it('returns 51', () => {
    expect(findK(46288, 3)).toBe(51);
  });

  it('returns -1', () => {
    expect(findK(92, 1)).toBe(-1);
  });
});
