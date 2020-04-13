# ==========================================================
# This file updates the contents of Helm values file for CI.
# Note: Do not run this script locally!
# ==========================================================
import yaml
import os

fname = "./k8s/values.yaml"
stream = open(fname, 'r')
data = yaml.load(stream, Loader=yaml.FullLoader)

data['image']['tag'] = os.getenv("RELEASE_VERSION", "0.1.0")
data['db']['username'] = os.getenv("DB_USERNAME", "")
data['db']['password'] = os.getenv("DB_PASSWORD", "")
data['db']['host'] = os.getenv("DB_DATABASE", "")
data['db']['database'] = os.getenv("DB_HOST", "")

data['smtp']['host'] = os.getenv("SMTP_HOST", "")
data['smtp']['port'] = os.getenv("SMTP_PORT", "")
data['smtp']['username'] = os.getenv("SMTP_USERNAME", "")
data['smtp']['password'] = os.getenv("SMTP_PASSWORD", "")

with open(fname, 'w') as yaml_file:
    yaml_file.write(yaml.dump(data, default_flow_style=False))
