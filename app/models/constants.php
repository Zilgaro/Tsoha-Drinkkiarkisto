<?php
class Constants extends BaseModel {
	private static $drink_types = array('Cobbler', 'Cocktail', 'Cooler', 'Crusta', 'Cup', 'Fix', 'Fizz', 'Flip', 'Highball', 'Julep', 'Punssi', 'Pousse-café', 'Sour', 'Sling', 'Muu/Määrittelemätön'
		);
	private static $glass_types = array('Aromilasi', 'Cocktaillasi', 'Collinslasi', 'Grogilasi', 'Highball-lasi', 'Hurricanelasi', 'Irish coffee -lasi', 'Jalallinen liköörilasi', 'Kahvikuppi', 'Kuohuviinilasi', 'Margaritalasi', 'Old fashioned -lasi', 'Olutlasi', 'On the rocks -lasi', 'Portviinilasi', 'Shottilasi', 'Sourlasi', 'Totilasi', 'Valkoviinilasi', 'Muu/Määrittelemätön');

	public static function getDrinkTypes() {
		return self::$drink_types;
	}

	public static function getGlassTypes() {
		return self::$glass_types;
	}
}