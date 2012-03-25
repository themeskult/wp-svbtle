#! /bin/bash
# wp-subtle development installation
CURRENT_PATH=`pwd`
THEME_PATH=$CURRENT_PATH"/wp-content/themes/subtle"
FOLDER_PATH=$CURRENT_PATH"/wp-subtle"

#installation function
install() {
    if [ -z $2 ]; then
        echo "Installation requires the path to wordpress folder as its argument"
        exit 1
    fi
 	
 	if [ $1 == "all" ]; then
 		cd $2
 		RV=$?
 		if [ -z $? ]; then
 			echo "Bad path provided..."
 			echo "Can\'t \'cd\' to "$2"\n"
 			exit 1
 		else
	 		echo "Copying theme and folder into "$2"\n"
	 		cp -r $THEME_PATH "wp-content/themes/subtle"
	 		cp -r $FOLDER_PATH "wp-subtle"
 		fi

 	elif [ $1 == "theme" ]; then
 		cd $2
 		RV=$?
 		if [ -z $? ]; then
 			echo "Bad path provided..."
 			echo "Can\'t \'cd\' to "$2"\n"
 			exit 1
 		else
	 		echo "Copying theme into "$2"wp-content/themes/subtle/\n"
	 		cp -r $THEME_PATH "wp-content/themes/subtle"
 		fi

 	elif [ $1 == "folder" ]; then
 		cd $2
 		RV=$?
 		if [ -z $? ]; then
 			echo "Bad path provided..."
 			echo "Can\'t \'cd\' to "$2"\n"
 			exit 1
 		else
	 		echo "Copying folder into "$2"wp-subtle/\n"
	 		cp -r $FOLDER_PATH "wp-subtle"
 		fi
 	fi
}

update() {
    if [ -z $2 ]; then
        echo "Installation requires the path to wordpress folder as its argument"
        exit 1
    fi
 	
 	if [ $1 == "all" ]; then
 		cd $2
 		RV=$?
 		if [ -z $? ]; then
 			echo "Bad path provided..."
 			echo "Can\'t \'cd\' to "$2"\n"
 			exit 1
 		else
	 		echo "Copying theme and folder into "$2"\n"
	 		cp -r "wp-content/themes/subtle" $THEME_PATH
	 		cp -r "wp-subtle" $FOLDER_PATH
 		fi

 	elif [ $1 == "theme" ]; then
 		cd $2
 		RV=$?
 		if [ -z $? ]; then
 			echo "Bad path provided..."
 			echo "Can\'t \'cd\' to "$2"\n"
 			exit 1
 		else
	 		echo "Copying theme into "$2"wp-content/themes/subtle/\n"
	 		cp -r "wp-content/themes/subtle" $THEME_PATH
 		fi

 	elif [ $1 == "folder" ]; then
 		cd $2
 		RV=$?
 		if [ -z $? ]; then
 			echo "Bad path provided..."
 			echo "Can\'t \'cd\' to "$2"\n"
 			exit 1
 		else
	 		echo "Copying folder into "$2"wp-subtle/\n"
	 		cp -r "wp-subtle" $FOLDER_PATH
 		fi
 	fi
}

if [ "$1" == "install_all" ]; then
    install 'all' $2
elif [ "$1" == "install_folder" ]; then
    install 'folder' $2
elif [ "$1" == "install_theme" ]; then
    install 'theme' $2
elif [ "$1" == "update_all" ]; then
    install 'all' $2
elif [ "$1" == "update_theme" ]; then
    install 'theme' $2
elif [ "$1" == "update_folder" ]; then
    install 'folder' $2
else
    echo "\
Usage: wp-subtle.sh 	install[_all|_folder|_theme] [path_to_wordpress_folder] \n\
			update[_folder|_theme] [path_to_wordpress_folder] \n\n\

!!!   Make sure you provide a valid folder\n\
!!!   This script copies all files from this git repo to provided folder\n\
    for development purpose only.\n\
!!!   Be sure to uninstall this with the appropiate command and path.\n\

ENJOY!!"
fi
