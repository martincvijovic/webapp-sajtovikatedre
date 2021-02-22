sudo apt update
sudo apt install python3-pip
sudo -H pip3 install virtualenv

mkdir $1
cp runJupyter.sh ./$1
cd $1

cp ../oe3dosRequirements.txt ./

virtualenv venv
source venv/bin/activate

pip3 install -r oe3dosRequirements.txt

wget https://nodejs.org/dist/v12.18.4/node-v12.18.4-linux-x64.tar.xz
tar -xvf node-v12.18.4-linux-x64.tar.xz
cp -r node-v12.18.4-linux-x64/* venv/
rm -r node-v12.18.4-linux-x64.tar.xz node-v12.18.4-linux-x64

jupyter labextension install @jupyterlab/debugger

jupyter labextension install @jupyter-widgets/jupyterlab-manager
jupyter labextension install jupyter-matplotlib
jupyter nbextension enable --py widgetsnbextension

deactivate