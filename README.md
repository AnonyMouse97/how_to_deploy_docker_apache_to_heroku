# How to deploy Docker with Apache to Heroku ?

I realize this tutorial to allow my teammate to be able to deploy their "Cogip" project which is requested of us during our training at BeCode Liège.

Apache, by default, listens on port 80 (HTTP), this isn’t a problem when running the server on your machine. But some cloud providers require that containers use different ports.

In this repository I will detail how to configure an apache environment to deploy it on heroku.


## Set up

For this tutorial you will need :
- Docker
- Free Heroku account
- Heroku CLI set up on your machine for easier use
- Composer (Included in the ``Dockerfile``)
- Your project deployed to GitHub

I suggest you use the same `Dockerfile` and `docker-compose.yml` from this repository (do not forget the `conf` folder).

> **NOTE:** There are two possibilities for your database. You can use it locally but Heroku will need an add-on like [ClearDB MySQL](https://devcenter.heroku.com/articles/cleardb) (There is a free option but Heroku requires you to enter a credit card). For this project I would use [RemoteMySQL](https://remotemysql.com/) which is a free remote database.

> **NOTE2:** Ensure the start-apache file in the `conf` folder is exectable with de command line below 
```
chmod 755 start-apache
```


## Install Heroku CLI

The first step is to install the Heroku command lines.

- For Ubuntu
    ```
    sudo snap install --classic heroku
    ```
- For MacOS
    ```
    brew tap heroku/brew && brew install heroku
    ```

You can refer to this guide [Install Heroku CLI](https://devcenter.heroku.com/articles/heroku-cli).



## Deploy Docker to Heroku

### Link your github project to Heroku

- Go to this [link](https://dashboard.heroku.com/new-app) and create your project

- Go to deploy and select "Connect to GitHub"

- Go to automatic deploy, select your branch and enable automatic deployment

### Now that your project is linked to Heroku, we need to tell it that we are using docker


In your terminal at the root of your project type :
- Log in to Container Registry:
    ```
    heroku container:login
    ```

- Apache configuration
    ```
    heroku labs:enable --app=YOUR_HEROKU_APP_NAME runtime-new-layer-extract
    ```

- Make sure your stack is in a container
    ```
    heroku stack:set container --app YOUR_HEROKU_APP_NAME
    ```
- Build the image and push to Container Registry:
    ```
    heroku container:push web --app YOUR_HEROKU_APP_NAME
    ```

- Then release the image to your app:
    ```
    heroku container:release web --app YOUR_HEROKU_APP_NAME
    ```