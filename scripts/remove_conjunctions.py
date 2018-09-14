
import os
# os.environ['APPDATA'] = "."

import nltk
from nltk.tag import CRFTagger
import numpy as np

if (len(os.sys.argv) < 2):
    exit()

# Tokenize input text
input_text = nltk.word_tokenize(os.sys.argv[1])

# Initialize tagger
ct = CRFTagger()
ct.set_model_file(os.path.dirname(os.path.abspath(__file__)) + '/all_indo_man_tag_corpus_model.crf.tagger')

# Tag sentence
result = ct.tag_sents([ input_text ])

forbidden_tags = ['SC', 'IN', 'CC']
for index, sentence in enumerate(result):
    result[index] = [word for word in sentence if word[1] not in forbidden_tags]

output = ''
for sentence in result:
    for word in sentence:
        output = output + ' ' + word[0]

print(str.strip(output))
