#!/usr/bin/env bash

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

USERID=$(id -u)
GROUP=$(id -g)

cat > $DIR/php7/createuser.sh <<DELIM
#!/usr/bin/env bash

groupadd -o -g ${GROUP} app-shell
useradd -s /bin/bash -m -u ${USERID} -g ${GROUP} app-shell
mkdir -p /home/app-shell/.ssh
chown -R app-shell:app-shell /home/app-shell
echo -e "app-shell\napp-shell\n" | passwd app-shell
echo 'app-shell  ALL=(ALL:ALL) NOPASSWD: ALL' >> /etc/sudoers
DELIM

echo "Created "$DIR/php7/createuser.sh