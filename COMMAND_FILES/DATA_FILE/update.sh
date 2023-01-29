#!/bin/bash
echo
echo
echo
webhookName="umutkaratools-ukt"
printf "Heroku > \e[32m"
curl -s https://$webhookName.herokuapp.com/COMMAND_FILES/DATA_FILE/members.json |jq .[].id |wc -l
echo
echo
echo
printf "\e[0mFile > \e[32m"
cat members.json |jq .[].id |wc -l
echo
echo
echo
if [[ $1 == --update ]];then
	curl -s https://$webhookName.herokuapp.com/COMMAND_FILES/DATA_FILE/members.json > members.json
	echo
	echo
	printf "\e[32mTrue"
	echo
	echo
	exit
fi
