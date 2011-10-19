<?php

	$article_name = (isset($article_name)) ? $article_name : '';
	if (!TBGContext::isProjectContext() || (TBGContext::isProjectContext() && mb_strtolower($article_name) != mb_strtolower(TBGContext::getCurrentProject()->getKey() . ':mainpage')))
	{
		if (TBGContext::isProjectContext())
		{
			$csp_response->addBreadcrumb(TBGPublish::getModule()->getMenuTitle(), make_url('publish_article', array('article_name' => TBGContext::getCurrentProject()->getKey() . ':MainPage')), tbg_get_breadcrumblinks('project_summary', TBGContext::getCurrentProject()));
		}
		else
		{
			$csp_response->addBreadcrumb(TBGPublish::getModule()->getMenuTitle(), make_url('publish_article', array('article_name' => 'MainPage')), tbg_get_breadcrumblinks('main_links'));
		}
		$items = explode(':', $article_name);
		$bcpath = array_shift($items);
		if (mb_strtolower($bcpath) == 'category')
		{
			$csp_response->addBreadcrumb(__('Categories'));
			if (TBGContext::isProjectContext())
			{
				$bcpath .= ":".array_shift($items);
			}
		}
		elseif (!TBGContext::isProjectContext() && mb_strtolower($bcpath) != 'mainpage')
		{
			$csp_response->addBreadcrumb($bcpath, make_url('publish_article', array('article_name' => $bcpath)));
		}
		foreach ($items as $bc_name)
		{
			$bcpath .= ":".$bc_name;
			$csp_response->addBreadcrumb($bc_name, make_url('publish_article', array('article_name' => $bcpath)));
		}
	}
	else
	{
		$csp_response->addBreadcrumb(TBGPublish::getModule()->getMenuTitle(), make_url('publish_article', array('article_name' => TBGContext::getCurrentProject()->getKey() . ':MainPage')), tbg_get_breadcrumblinks('project_summary', TBGContext::getCurrentProject()));
	}
