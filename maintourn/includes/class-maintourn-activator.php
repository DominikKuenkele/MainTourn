<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Maintourn
 * @subpackage Maintourn/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Maintourn
 * @subpackage Maintourn/includes
 * @author     Your Name <email@example.com>
 */
class Maintourn_Activator
{

	const DB_PLUGIN_PREFIX = "maintourn_";

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate()
	{
		self::createDatabaseTables();
	}

	private static function createDatabaseTables()
	{
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();

		$db_prefix = $wpdb->prefix . self::DB_PLUGIN_PREFIX;

		$table_name_tournaments = $db_prefix . 'tournaments';
		$table_name_teams = $db_prefix . 'teams';
		$table_name_types = $db_prefix . 'types';
		$table_name_tournament_participation = $db_prefix . 'tournament_participation';
		$table_name_tournament_type = $db_prefix . 'tournament_type';

		$query_tournament = "CREATE TABLE $table_name_tournaments (
			tournament_id mediumint(9) NOT NULL AUTO_INCREMENT,
			name varchar(100) NOT NULL,
			location varchar(50) NOT NULL,
			startdate date NOT NULL,
			enddate date NOT NULL,
			deadline date,
			admitted_teams varchar(50) NOT NULL,
			infos varchar(200),
			PRIMARY KEY (tournament_id)
		) $charset_collate;";

		$query_teams = "CREATE TABLE $table_name_teams (
			team_id smallint(3) NOT NULL AUTO_INCREMENT,
			short_name varchar(10) NOT NULL
			PRIMARY KEY (team_id)
		) $charset_collate;";

		$query_types = "CREATE TABLE $table_name_types (
			type_id tinyint(2) NOT NULL AUTO_INCREMENT,
			name varchar(20) NOT NULL,
			abbreviation varchar(3) NOT NULL,
			PRIMARY KEY (type_id)
		) $charset_collate;";

		$query_tournament_participation = "CREATE TABLE $table_name_tournament_participation (
			tournament_participation_id mediumint(9) NOT NULL AUTO_INCREMENT,
			team_id smallint(3) NOT NULL,
			tournament_id mediumint(9) NOT NULL,
			PRIMARY KEY (tournament_participation_id),
			FOREIGN KEY (team_id) REFERENCES $table_name_teams (team_id),
			FOREIGN KEY (tournament_id) REFERENCES $table_name_tournaments (tournament_id)
		) $charset_collate;";

		$query_tournament_type = "CREATE TABLE $table_name_tournament_type (
			tournament_type_id mediumint(9) NOT NULL AUTO_INCREMENT,
			tournament_id smediumint(9) NOT NULL,
			type_id tinyint(2) NOT NULL,
			PRIMARY KEY (tournament_type_id),
			FOREIGN KEY (tournament_id) REFERENCES $table_name_tournaments (tournament_id),
			FOREIGN KEY (type_id) REFERENCES $table_name_types (type_id)
		) $charset_collate;";

		$queries = [
			$query_tournament,
			$query_teams,
			$query_types,
			$query_tournament_participation,
			$query_tournament_type
		];

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		foreach ($queries as $sql) {
			dbDelta($sql);
		}
	}
}
