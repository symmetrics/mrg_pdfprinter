# encoding: utf-8


# =============================================================================
# package info
# =============================================================================
NAME = 'symmetrics_module_pdfprinter'

TAGS = ('symmetrics', 'magento', 'pdf', 'module', 'php', 'generate', 'mrg')

LICENSE = 'AFL 3.0'

HOMEPAGE = 'http://www.symmetrics.de'

INSTALL_PATH = ''


# =============================================================================
# responsibilities
# =============================================================================
TEAM_LEADER = {
    'Torsten Walluhn': 'tw@symmetrics.de',
}

MAINTAINER = {
    'Eric Reiche': 'er@symmetrics.de',
}

AUTHORS = {
    'Eric Reiche': 'er@symmetrics.de',
}

# =============================================================================
# additional infos
# =============================================================================
INFO = 'Generate PDF files from CMS pages'

SUMMARY = '''
uses DOMPDF
'''

NOTES = '''
Not compatible with magento 1.3 or below
'''

# =============================================================================
# relations
# =============================================================================
REQUIRES = [
     {'magento': '*', 'magento_enterprise': '*'},
]

EXCLUDES = {
     'magento': ['1.3.2.0', '1.3.2.1', '1.3.2.2', '1.3.2.3', '1.3.2.4'],
     'magento_enterprise': ['1.3.2.0', '1.3.2.1', '1.3.2.2', '1.3.2.3', '1.3.2.4'],
}

VIRTUAL = {}

DEPENDS_ON_FILES = ()

PEAR_KEY = ''

COMPATIBLE_WITH = {
     'magento': ['1.4.0.0'],
     'magento_enterprise': ['1.7.0.0', '1.7.1.0', '1.8.0.0']
}