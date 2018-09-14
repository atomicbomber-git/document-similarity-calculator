#!/bin/bash

mkdir local_env
virtualenv -p python3 local_env
bash
source local_env/bin/activate
pip install nltk
pip install numpy
pip install python-crfsuite
python -m nltk.downloader punkt -d local_env/nltk_data