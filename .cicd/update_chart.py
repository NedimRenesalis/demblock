# ==========================================================
# This file updates the contents of Helm values file for CI.
# Note: Do not run this script locally!
# ==========================================================
import yaml
import os

# === Helm chart files
fname = "./k8s/values.yaml"
chart_name = "./k8s/Chart.yaml"
# Open files
stream, chart_stream = open(fname, 'r'), open(chart_name, 'r')
data, chart_data = yaml.load(stream, Loader=yaml.FullLoader), yaml.load(chart_stream, Loader=yaml.FullLoader)

# === Update values.yaml
data['image']['repository'] = os.getenv("GCP_PROJECT") + "/" + os.getenv("ARTIFACT_NAME")
data['image']['tag'] = os.getenv("RELEASE_VERSION", "v0.1.0")
data['db']['host'] = os.getenv("DB_HOST", "")
data['db']['database'] = os.getenv("DB_DATABASE", "")

data['smtp']['host'] = os.getenv("SMTP_HOST", "")
data['smtp']['port'] = os.getenv("SMTP_PORT", "")

# === Update Chart.yaml
chart_data['version'] = os.getenv("RELEASE_VERSION", "v0.1.0")

# Save files
with open(fname, 'w') as yaml_file:
    yaml_file.write(yaml.dump(data, default_flow_style=False))

with open(chart_name, 'w') as yaml_file:
    yaml_file.write(yaml.dump(chart_data, default_flow_style=False))
