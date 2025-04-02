# Table of Contents
1. [Installing a Project in Local Environment](#installing-a-project-in-local-environment)
    - [Requirements](#requirements)
        - [Docker Installation](#docker-installation)
        - [Install GNU Make](#install-gnu-make)
    - [Description of Main Environment Variables](#description-of-main-environment-variables)
    - [Project Setup](#project-setup)
2. [Connecting SSL Certificates](#connecting-ssl-certificates)
    - [Steps to Add Certificates](#steps-to-add-certificates)
3. [Finalizing Setup](#finalizing-setup)

---

## Installing a Project in Local Environment

### Requirements

- **Docker**
- **GNU Make utility**

#### Docker Installation

How to install and run Docker Desktop on Mac: [Docker Mac Installation Guide](https://docs.docker.com/desktop/install/mac-install/).

If you are using Windows - **СТРАДАЙТЕ И ЕБИТЕСЬ ПОКА ВСЕ НА ЗАРАБОТАЕТ, НОРМАЛЬНЫЙ РАЗРАБ ЮЗАЕТ MacOS!**

#### Install GNU Make

1. Open **Terminal** (located in Applications/Utilities).
2. In the terminal window, run the command:
    ```bash
    xcode-select --install
    ```
3. In the window that appears, click **Install** and agree to the **Terms of Service**.

### Description of Main Environment Variables

The primary environment variables for development are located in the `.docker/local/.env` file.

The most important variables are:

- **PROJECT_NAME=hr-saas**  
  *Name of the project.*

- **CI_REGISTRY=registry.gitlab.com**  
  *URL of the GitLab Container Registry.*

- **CI_PROJECT_PATH=p2tech/hr.saas**  
  *Path to the project's registry.*

- **PROJECT_DOMAIN=hr.saas**  
  *Primary domain through which the project will be accessible during development.*

- **ENVIRONMENT_NAME=local**  
  *Specifies the environment where the application is running, whether it's local development or production.*

**Attention!**  
When changing the `PROJECT_DOMAIN`, new certificates will be generated and placed in the `.docker/local/traefik/ssl` directory. You must then update the Traefik configuration in `.docker/local/traefik/dynamic.yml`; otherwise, the certificates will not function correctly.

### Project Setup

1. **Copy Environment Variables**  
   Run the following command to copy environment variables:
    ```bash
    make copy-envs
    ```

2. **Setup**  
   Perform any necessary setup steps as required by your project.

3. **Run Initialization Script**
    ```bash
    make init
    ```

4. **Start Service**
    ```bash
    make up
    ```

---

## Connecting SSL Certificates

All necessary certificates, including root certificates (`rootCA`), are located in the `.docker/local/traefik/ssl` folder.

You need to add them to your system's key stores and mark them as trusted. The process varies depending on your operating system (macOS or Windows). Otherwise, browsers will flag the certificates as untrusted when accessing websites.

### Steps to Add Certificates

1. **Locate the Certificates:**
    - Path: `.docker/local/traefik/ssl`

2. **Add to Key Store:**
    - **macOS:**
        - Open **Keychain Access**.
        - Import the certificates.
        - Set each certificate to **"Always Trust"**.
    - **Windows:**
        - Open the **Certificates** snap-in.
        - Import the certificates into the **"Trusted Root Certification Authorities"** store.

By following these steps, you ensure that your system recognizes and trusts the SSL certificates, preventing browser warnings about untrusted certificates.

---

## Finalizing Setup

Restart services:
```bash
    make up
```

Now you're good to go.
