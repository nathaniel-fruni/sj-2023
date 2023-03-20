<?php

namespace main;
class Menu
{
    //private $filePath = "source/headerMenu.json";
    private function validateMenuType(string $menuType): bool
    {
        $validTypes = [
            'header',
            'footer',
            'main'
        ];

        if (in_array($menuType, $validTypes)) {
            return true;
        } else {
            return false;
        }
    }
    public function getMenu(string $type): array
    {
        $menu = [];
        $isValid =  $this->validateMenuType($type);

        if ($isValid) {
            if ($type==="header") {
                try {
                    //$menuJson = file_get_contents($this->filePath);
                    //$menu = json_decode($menuJson, true);
                    $menu = array_map('str_getcsv', file('source/menuHeader.csv'));
                } catch (\Exception $exception) {
                    //echo $exception->getMessage();
                    $menu = [
                        'home' => [
                            'path' => 'index.php',
                            'name' => 'Domov',
                        ]
                    ];
                }
            }
        }

        return $menu;
    }

    public function printMenu(array $menu)
    {
        /*foreach ($menu as $key => $menuItem) {
            echo '<li><a href="'.$menuItem['path'].'">'.$menuItem['name'].'</a></li>';
        }*/
        foreach ($menu as $key) {
            echo '<li><a href="'.$key[0].'">'.$key[1].'</a></li>';
        }
    }

    public function preparePortfolio(int $numberOfRows = 2, int $numberOfCols = 4): array
    {
        $portfolio = [];
        $colIndex = 1;

        for ($i = 1; $i <= $numberOfRows; $i++) {
            for ($j = 1; $j <= $numberOfCols; $j++) {
                $portfolio[$i][] = $colIndex; //prvok portfolia s klucom $i a hodnotou [] postupne naplní tuto hodnotu(zoznam)
                $colIndex++;
            }
        }

        return $portfolio;  # [1 => [1,2,3,4], 2 => [5,6,7,8]];
    }

}

?>