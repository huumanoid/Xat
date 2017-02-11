def smexist(sm)
	smsave	= Array.new
	smlist	= "3d cry2 inlove punk think 6 crying jolly redface tongue a cyc kiss roll un backoff d mad rolleyes vampire beye dead ninja rolling wary biggrin eek nme sad what blk emo no scn wink cb frown nod shh wt cd fs nrd shock xd chew g1 o_o sleep xp chkl gagged omg sleepy yawn clap goo ono smile yum confused goth party smirk cool hello pce smirk2 crazy hmm pirate sry crs hug puke swt"
	smlist	= smlist.split(" ")
	for i in (0..smlist.length)
		if sm == smlist[i]
			smsave.push(sm)
		end
	end
	if smsave.length > 0
		return true
	end
end

if argu != ""
	smiley	= argu
	if ((smiley[0] == "(") && (smiley[-1] == ")"))
		scan = smiley.scan(/#/)
		if scan[0] != nil
			explode = smiley.split("#")
			smname	= explode[0].split("(")[1]
			check 	= smexist(smname) ? "[#{smname}'s smiley] Old: (#{smname}#wc) | New: (#{smname})" : "This smilie has not been changed."
		else
			explode	= smiley.split(")")
			smname	= explode[0].split("(")[1]
			check 	= smexist(smname) ? "[#{smname}'s smiley] Old: (#{smname}#wc) | New: (#{smname})" : "This smilie has not been changed."
		end
	else 
		sm	= argu.gsub(/[^a-zA-Z0-9\-]/,"") 
		check	= smexist(smiley) ? "[#{sm}'s smiley] Old: (#{sm}#wc) | New: (#{sm})" : "This smilie has not been changed."
	end	
	Thread.current["from"].print packet("m",{"t" => check, "u" => 0})
else
	Thread.current["from"].print packet("m",{"t" => "Usage: @old [SMILEY name]", "u" => 0})
end
