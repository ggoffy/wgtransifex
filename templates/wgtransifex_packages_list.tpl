<div class='panel-heading'>
</div>
<div class='panel-body'>
	<div class='col-sm-2'>
		<img class='img-responsive' src="<{$wgtransifex_upload_url}>/logos/<{$package.logo}>" alt="<{$package.name}>" title="<{$package.name}>">
	</div>
	<div class='col-sm-10'>
		<span class='package-line col-sm-9 justify'><{$smarty.const._MA_WGTRANSIFEX_PACKAGE_NAME}>: <{$package.name}></span>
		<{if $package.desc}>
			<span class='package-line col-sm-9 justify'><{$smarty.const._MA_WGTRANSIFEX_PACKAGE_DESC}>: <{$package.desc}></span>
		<{/if}>
		<span class='package-line col-sm-9 justify'><{$smarty.const._MA_WGTRANSIFEX_PACKAGE_LANG_ID}>: <img src="<{$modPathIconFlags}><{$package.lang_flag}>" alt="<{$package.name}>" title="<{$package.name}>" /> <{$package.lang_id}></span>
		<span class='package-line col-sm-9 justify'><{$smarty.const._MA_WGTRANSIFEX_PACKAGE_DATE}>: <{$package.date}></span>
	</div>
</div>
<div class='panel-foot'>
	<span class='col-sm-12'><a class='btn btn-primary' href='packages.php?op=show&amp;pkg_id=<{$package.pkg_id}>' title='<{$smarty.const._MA_WGTRANSIFEX_DETAILS}>'><{$smarty.const._MA_WGTRANSIFEX_DETAILS}></a></span>
</div>
