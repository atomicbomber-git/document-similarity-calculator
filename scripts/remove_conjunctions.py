import nltk
from nltk.tag import CRFTagger
import numpy as np
from os import sys

if (len(sys.argv) < 2):
    exit()

# Tokenize input text
input_text = nltk.word_tokenize(sys.argv[1])

# Initialize tagger
ct = CRFTagger()
ct.set_model_file('./all_indo_man_tag_corpus_model.crf.tagger')

# Tag sentence
result = ct.tag_sents([ input_text ])

forbidden_tags = ['SC', 'IN']
for index, sentence in enumerate(result):
    result[index] = [word for word in sentence if word[1] not in forbidden_tags]

output = ''
for sentence in result:
    for word in sentence:
        output = output + ' ' + word[0]

print(output)