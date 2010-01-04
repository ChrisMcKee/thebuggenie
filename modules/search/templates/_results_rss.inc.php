<<?php ?>?xml version="1.0" encoding="<?php echo BUGScontext::getI18n()->getCharset(); ?>" ?>
<rss version="2.0">
	<channel>
		<title><?php echo BUGSsettings::getTBGname() . ' ~ '. $searchtitle; ?></title>
		<link><?php echo BUGSsettings::getURLhost() . BUGSsettings::getURLsubdir(); ?></link>
		<description> </description>
		<language><?php echo BUGScontext::getI18n()->getCurrentLanguage(); ?></language>
		<image>
			<url><?php print BUGScontext::getTBGPath(); ?>themes/<?php print BUGSsettings::getThemeName(); ?>/favicon.png</url>
			<title><?php echo BUGSsettings::getTBGname() . ' ~ '. $searchtitle; ?></title>
			<link><?php echo BUGSsettings::getURLhost() . BUGSsettings::getURLsubdir(); ?></link>
		</image>
<?php foreach ($issues as $issue): ?>

		<item>
			<title><?php echo $issue->getFormattedIssueNo(true) . ' - ' . $issue->getTitle(); ?></title>
			<description><?php echo tbg_parse_text($issue->getDescription()); ?></description>
			<pubdate><?php echo bugs_formatTime($issue->getLastUpdatedTime(), 21); ?></pubdate>
			<link><?php echo make_url('viewissue', array('issue_no' => $issue->getFormattedIssueNo(), 'project_key' => $issue->getProject()->getKey()), false); ?></link>
			<guid><?php echo make_url('viewissue', array('issue_no' => $issue->getFormattedIssueNo(), 'project_key' => $issue->getProject()->getKey()), false); ?></guid>
		</item>
<?php endforeach; ?>
		
	</channel>
</rss>