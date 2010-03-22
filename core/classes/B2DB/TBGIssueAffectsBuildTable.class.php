<?php

	/**
	 * Issue affects build table
	 *
	 * @author Daniel Andre Eikeland <zegenie@zegeniestudios.net>
	 * @version 2.0
	 * @license http://www.opensource.org/licenses/mozilla1.1.php Mozilla Public License 1.1 (MPL 1.1)
	 * @package thebuggenie
	 * @subpackage tables
	 */

	/**
	 * Issue affects build table
	 *
	 * @package thebuggenie
	 * @subpackage tables
	 */
	class TBGIssueAffectsBuildTable extends B2DBTable 
	{

		const B2DBNAME = 'issueaffectsbuild';
		const ID = 'issueaffectsbuild.id';
		const SCOPE = 'issueaffectsbuild.scope';
		const ISSUE = 'issueaffectsbuild.issue';
		const BUILD = 'issueaffectsbuild.build';
		const CONFIRMED = 'issueaffectsbuild.confirmed';
		const STATUS = 'issueaffectsbuild.status';
		
		public function __construct()
		{
			parent::__construct(self::B2DBNAME, self::ID);
			parent::_addBoolean(self::CONFIRMED);
			parent::_addForeignKeyColumn(self::BUILD, B2DB::getTable('TBGBuildsTable'), TBGBuildsTable::ID);
			parent::_addForeignKeyColumn(self::ISSUE, B2DB::getTable('TBGIssuesTable'), TBGIssuesTable::ID);
			parent::_addForeignKeyColumn(self::SCOPE, B2DB::getTable('TBGScopesTable'), TBGScopesTable::ID);
			parent::_addForeignKeyColumn(self::STATUS, B2DB::getTable('TBGListTypesTable'), TBGListTypesTable::ID);
		}
		
		public function getByIssueID($issue_id)
		{
			$crit = $this->getCriteria();
			$crit->addWhere(self::ISSUE, $issue_id);
			$res = $this->doSelect($crit);
			return $res;
		}
		
		public function getByIssueIDandBuildID($issue_id, $build_id)
		{
			$crit = $this->getCriteria();
			$crit->addWhere(self::BUILD, $build_id);
			$crit->addWhere(self::ISSUE, $issue_id);
			$res = $this->doSelectOne($crit);
			return $res;
		}
		
		public function setIssueAffected($issue_id, $build_id)
		{
			if (!$this->getByIssueIDandBuildID($issue_id, $build_id))
			{
				$crit = $this->getCriteria();
				$crit->addInsert(self::ISSUE, $issue_id);
				$crit->addInsert(self::BUILD, $build_id);
				$crit->addInsert(self::SCOPE, TBGContext::getScope()->getID());
				$this->doInsert($crit);
				return true;
			}
			else
			{
				return false;
			}
		}
		
		public function deleteByBuildID($build_id)
		{
			$crit = $this->getCriteria();
			$crit->addWhere(self::BUILD, $build_id);
			$this->doDelete($crit);
		}
		
		public function deleteByIssueIDandBuildID($issue_id, $build_id)
		{
			if (!$this->getByIssueIDandBuildID($issue_id, $build_id))
			{
				return false;
			}
			else
			{
				$crit = $this->getCriteria();
				$crit->addWhere(self::ISSUE, $issue_id);
				$crit->addWhere(self::BUILD, $build_id);
				$this->doDelete($crit);
				return true;
			}
		}

		public function confirmByIssueIDandBuildID($issue_id, $build_id, $confirmed = true)
		{
			if (!$this->getByIssueIDandBuildID($issue_id, $build_id))
			{
				return false;
			}
			else
			{
				$crit = $this->getCriteria();
				$crit->addUpdate(self::CONFIRMED, $confirmed);
				$this->doUpdateById($crit, $res->get(self::ID));
			}				
		}
		
		public function setStatusByIssueIDandBuildID($issue_id, $build_id, $status_id)
		{
			if (!$this->getByIssueIDandBuildID($issue_id, $build_id))
			{
				return false;
			}
			else
			{
				$crit = $this->getCriteria();
				$crit->addUpdate(self::STATUS, $status);
				$this->doUpdateById($crit, $res->get(self::ID));
			}				
		}
		
	}