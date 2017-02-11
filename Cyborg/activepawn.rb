pawns	= Array.new
pow2	= JSON.parse(eat("http://xat.com/web_gear/chat/pow2.php?Sloom=#{Time.now.getutc}"))

pow2[7][1].each do |i,c|
	if i != "time" and i != "!"
		pawns.push("hat#h#{i}")
	end
end

newpawn	= pawns.join(", ")
Thread.current["from"].print packet("m", {"t" => "Current pawns: #{newpawn}.", "u" => 0})
