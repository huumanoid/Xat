if argu != ""	
	name 	= args[0]
	wiki	= munch("http://util.xat.com/wiki/index.php?title=#{name}")	
	if !wiki
		Thread.current["from"].print packet("m", {"t" => "Wiki page could not be found. | Usage: @wiki [Topic]", "u" => 0})
	else
		Thread.current["from"].print packet("m", {"t" => "Wiki page for #{name} : http://xat.wiki/#{name}", "u" => 0})
	end
else
	Thread.current["from"].print packet("m", {"t" => "Usage: @wiki [Topic]", "u" => 0})
end
