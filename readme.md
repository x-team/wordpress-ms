# WordPress Multisite test env for VVV

*/five*

## Dev Setup

The site was designed to get up and running quickly via a [fork][1] of [varying-vagrant-vagrants][2].

So to get started, follow the [First Vagrant Up][3] instructions, but instead of cloning from the **10up** repo,
clone from the **x-team** fork and checkout the `develop` branch instead:

```sh
git clone git@github.com:x-team/varying-vagrant-vagrants.git vvv
cd vvv
vagrant up --provision
```

Once you can verify that `local.wordpress.dev` is accessible on your local system, then you can proceed to add this `wordpress-ms` repo:

```sh
cd www
git clone git@github.com:x-team/wordpress-ms.git
cd wordpress-ms
echo vvv > config/active-env
vagrant reload --provision
```

Once this finishes (and you've added `local.wordpress-ms.dev` to your `hosts` file), you should be able to
access **[local.wordpress-ms.dev](http://local.wordpress-ms.dev/)** from your browser.

In the course of development, if you want to commit some change to the database, first connect with
any other developers who are currently working on the site and obtain a "verbal file lock" on `database/vvv-data.sql`,
as merging SQL is not possible. Once you're clear to commit your changes to the database dump, run:

```sh
bin/dump-db-vvv
git add -u database
git commit -m "Add some content X"
git push
```

Then let the other developers know to:

```sh
git pull
bin/load-db-vvv
```

If any commands complain about needing to be run in Vagrant, you first can `vagrant ssh` then `cd /srv/www/wordpress-ms`
to run the command. Or, you can set up [vassh](https://gist.github.com/westonruter/5992510) on your system which
allows you to prefix any command on your system to have it executed at the current working directory in the vagrant
environment. For example:

```sh
cd wordpress-ms
vassh wp core upgrade
vassh bin/dump-db-vvv
```

You can also use the `vasshin` command similarly—called without arguments it will drop you into the current directory
in vagrant (not the `vagrant` user's home directory); called with an command argument, it will execute the command in
the Vagrant environment with full interactive TTY mode and colored output.

## WordPress Admin User

User: `admin`  
Password: `password`

[1]: https://github.com/x-team/varying-vagrant-vagrants/tree/develop
[2]: https://github.com/10up/varying-vagrant-vagrants
[3]: https://github.com/x-team/varying-vagrant-vagrants/tree/develop#the-first-vagrant-up
