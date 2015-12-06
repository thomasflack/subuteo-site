define a2ensite {
    exec { 'a2ensite':
        require => Package['apache2'],
        path => [ '/bin', '/usr/bin', '/usr/sbin'],
        command => "a2ensite ${title}",
        notify => Service['apache2'],
    }
}

define a2dissite {
    exec { 'a2dissite':
        require => Package['apache2'],
        path => [ '/bin', '/usr/bin', '/usr/sbin'],
        command => "a2dissite ${title}",
        notify => Service['apache2']
    }
}

exec {'apt-get update':
	path => '/usr/bin',
}

package {'apache2':
	require => Exec['apt-get update'],
	ensure => present,
}

service {'apache2':
	ensure => running,
	require => Package['apache2'],
}

file {'/etc/apache2/sites-available/site.conf':
    ensure => present,
    require => Package['apache2'],
    source => '/vagrant/site.conf',
    notify => Service['apache2'],
}

a2dissite { '000-default.conf': }

a2ensite { 'site.conf': 
    require => File['/etc/apache2/sites-available/site.conf'],
}

file { '/var/www':
    ensure => link,
    target => '/vagrant/www',
    require => Package['apache2'],
    notify => Service['apache2'],
    force => true,
}

package {'mysql-server':
    require => Exec['apt-get update'],
    ensure => installed,
}

service {'mysql':
    require => Package['mysql-server'],
    ensure => running,
}

package {'php5':
    require => Exec['apt-get update'],
    ensure => installed,
}
