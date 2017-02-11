# Here we have all possible options for this cmd.
array   = ["background", "language", "radio", "buttons", "description"]

if args[0] != nil and args[1] != nil

	chat 	= args[1]
	option 	= args[0]	
	url 	= eat("http://xat.com/web_gear/chat/roomid.php?d=#{chat}&v2")	
	
	if url[0] == "-" # not valid json -> group not found
		Thread.current["from"].print packet("m", {"t" => "The chat &quot;#{chat}&quot; does not exist.", "u" => 0, "i" => "0"})	
	else	
		json	= JSON.parse(url)		
		returns = json["a"].split(";=")
		
		if option != nil and array.count(option) == 1 # args[0] -> not null and is in array of array
			if option == "background"
				returns[0] = returns[0] != "" ? returns[0] : "None"
				Thread.current["from"].print packet("m", {"t" => "#{json["g"]}'s background: #{returns[0]}", "u" => 0, "i" => "0"})	
			elsif option == "language"
				returns[3] = returns[3] != "" ? returns[3] : "None"
				Thread.current["from"].print packet("m", {"t" => "#{json["g"]}'s language: #{returns[3]}", "u" => 0, "i" => "0"})	
			elsif option == "radio"
				returns[4] = returns[4] != "" ? returns[4] : "None"
				Thread.current["from"].print packet("m", {"t" => "#{json["g"]}'s radio: #{returns[4]}", "u" => 0, "i" => "0"})	
			elsif option == "buttons"
				returns[5] = returns[5] != "- Cant" ? returns[5] : "None"
				Thread.current["from"].print packet("m", {"t" => "#{json["g"]}'s buttons: _#{returns[5]}", "u" => 0, "i" => "0"})	
			elsif option == "description"
				json["d"] = json["d"] != "" ? json["d"] : "None"
				Thread.current["from"].print packet("m", {"t" => "#{json["g"]}'s description: #{json["d"]}", "u" => 0, "i" => "0"})	
			end
		else # -> no in array or empty
			Thread.current["from"].print packet("m", {"t" => "Incorrect option ! Usage: @chatinfo [#{array.join(", ")}] [group]", "u" => 0, "i" => "0"})	
		end
	end
else 
	Thread.current["from"].print packet("m", {"t" => "Usage: @chatinfo [#{array.join(", ")}] [group]", "u" => 0, "i" => "0"})	
end
