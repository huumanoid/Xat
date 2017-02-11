def is_number? string
  true if Float(string) rescue false
end


if argu != ""
	
	money 	= args[0]
	cur1	= args[1]
	cur2	= args[2]
	
	if is_number?(money) and cur1 != nil and cur2 != nil # if money -> numeric and cur1/cur2 are not null.
		
		url	= eat("http://www.google.com/finance/converter?a=#{money}&from=#{cur1}&to=#{cur2}")
		ex	= url.split("<span class=bld>")
		
		if ex[1] != nil # if we found the ex[1] balise, we can continue!
			final		= ex[1].split("</span>")
			final2		= final[0].split(" ")
			currency	= final2[0].to_f.round
			
			Thread.current["from"].print packet("m", {"t" => "#{money} #{cur1.upcase} converts into #{currency} #{final2[1]}.", "u" => 0})
		else
			Thread.current["from"].print packet("m", {"t" => "Failed to convert, please try again.", "u" => 0})
		end
	else
		Thread.current["from"].print packet("m", {"t" => "Incorrect! Usage: @currency [money] [currency1] [currency2]", "u" => 0})
	end
			
else
	Thread.current["from"].print packet("m", {"t" => "Usage: @currency [money] [currency1] [currency2]", "u" => 0})
end
