    #!/bin/bash
    ### BEGIN INIT INFO
    # Provides:		php-fpm
    # Required-Start:       $network $remote_fs $syslog
    # Required-Stop:        $network $remote_fs $syslog
    # Default-Start:	2 3 4 5
    # Default-Stop:		0 1 6
    # Short-Description:	PHP-FPM server.
    # Description:		PHP is an HTML-embedded scripting language
    ### END INIT INFO
    # config: /usr/local/php/etc/php.ini
    PHP_PATH=/usr/local
    DESC="php-fpm daemon"
    NAME=php-fpm
    # php-fpm路径
    DAEMON=$PHP_PATH/php/sbin/$NAME
    # 配置文件路径
    CONFIGFILE=$PHP_PATH/php/etc/php-fpm.conf
    # PID文件路径(在php-fpm.conf设置)
    PIDFILE=$PHP_PATH/php/var/run/$NAME.pid
    SCRIPTNAME=/etc/init.d/$NAME

    # Gracefully exit if the package has been removed.
    test -x $DAEMON || exit 0

    rh_start() {
      $DAEMON -y $CONFIGFILE || echo -n " already running"
    }

    rh_stop() {
      kill -QUIT `cat $PIDFILE` || echo -n " not running"
    }

    rh_reload() {
      kill -HUP `cat $PIDFILE` || echo -n " can't reload"
    }

    case "$1" in
      start)
            echo -n "Starting $DESC: $NAME"
            rh_start
            echo "."
            ;;
      stop)
            echo -n "Stopping $DESC: $NAME"
            rh_stop
            echo "."
            ;;
      reload)
            echo -n "Reloading $DESC configuration..."
            rh_reload
            echo "reloaded."
      ;;
      restart)
            echo -n "Restarting $DESC: $NAME"
            rh_stop
            sleep 1
            rh_start
            echo "."
            ;;
      *)
             echo "Usage: $SCRIPTNAME {start|stop|restart|reload}" >&2
             exit 3
            ;;
    esac
    exit 0