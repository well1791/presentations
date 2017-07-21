module Solution where


sumPows :: Int -> Int -> Int
sumPows p = sum
          . foldl (\fs f -> (f $ p + length fs) : fs) []
          . map (^)
          . map (read . pure)
          . show

findK :: Int -> Int -> Int
findK n p = (\(div, mod) -> if mod == 0 then div else -1)
          . flip divMod n
          $ sumPows p n

-- | Helper Functions
{-
digits :: Integral n => n -> [n]
digits 0 = []
digits n = digits (n `div` 10) ++ [n `mod` 10]
-- -}
