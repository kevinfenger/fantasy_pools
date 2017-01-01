#/usr/bin/env python

import os.path
import sys
__base_path__ = os.path.abspath(os.path.join(os.path.dirname(__file__), '..'))
if sys.path[0] != __base_path__:
    sys.path.insert(0, __base_path__)

import json 
import urllib2

def build_insert_statements(d):
    players = d['body']['players'] 
    for p in players:
        try: 
            notes = p['icons']['headline'].replace('"', '\\"') 
        except KeyError: 
            notes = "Nothing New" 
        if p['position'] in ('K'): 
            print 'INSERT INTO players (position, full_name, first_name, last_name, pro_team, notes, image_url) VALUES("%s", "%s", "%s", "%s", "%s", "%s", "%s");' % (
              p['position'], 
              p['fullname'], 
              p['firstname'], 
              p['lastname'], 
              p['pro_team'],
              notes,
              p['photo'])

def get_json_document(url): 
    doc = urllib2.urlopen(url).read()
    return json.loads(doc)

rv = get_json_document('http://api.cbssports.com/fantasy/players/list?version=3.0&SPORT=football&response_format=json')
build_insert_statements(rv) 
