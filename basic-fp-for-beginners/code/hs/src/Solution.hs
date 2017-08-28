module Solution (findK) where


sumPows :: Int -> Int -> Int
sumPows p = sum
          . foldl (\fs f -> f (p + length fs) : fs) []
          . map (^)
          . toDigits

findK :: Int -> Int -> Int
findK n p = (\(div, mod) -> if mod == 0 then div else -1)
          . flip divMod n
          $ sumPows p n


-- | Helper Functions

toDigits :: Integral n => n -> [n]
toDigits 0 = []
toDigits n = digits (n `div` 10) ++ [n `mod` 10]
